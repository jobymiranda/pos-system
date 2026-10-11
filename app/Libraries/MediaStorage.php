<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;
use RuntimeException;

class MediaStorage
{
    public function storePreparedImage(
        UploadedFile $file,
        string $folder,
        int $width,
        int $height
    ): string {
        $mime = $file->getMimeType();

        $extension = match ($mime) {
            'image/png' => 'png',
            'image/jpeg', 'image/jpg' => 'jpg',
            default => throw new RuntimeException(
                'Unsupported image format.'
            ),
        };

        $fileName = bin2hex(random_bytes(16)) . '.' . $extension;
        $temporaryPath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR
            . 'casaforma-' . $fileName;

        service('image')
            ->withFile($file->getTempName())
            ->fit($width, $height, 'center')
            ->save($temporaryPath, 86);

        try {
            $token = (string) getenv('BLOB_READ_WRITE_TOKEN');

            if ($token !== '') {
                return $this->uploadToVercelBlob(
                    $temporaryPath,
                    trim($folder, '/') . '/' . $fileName,
                    $mime,
                    $token
                );
            }

            $directory = FCPATH
                . 'uploads'
                . DIRECTORY_SEPARATOR
                . trim($folder, '/');

            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $destination = $directory
                . DIRECTORY_SEPARATOR
                . $fileName;

            if (! copy($temporaryPath, $destination)) {
                throw new RuntimeException(
                    'The prepared image could not be stored.'
                );
            }

            return $fileName;
        } finally {
            if (is_file($temporaryPath)) {
                unlink($temporaryPath);
            }
        }
    }

    public function deleteLocal(?string $value, string $folder): void
    {
        if (
            $value === null
            || $value === ''
            || preg_match('#^https?://#i', $value) === 1
        ) {
            return;
        }

        $path = FCPATH
            . 'uploads'
            . DIRECTORY_SEPARATOR
            . trim($folder, '/')
            . DIRECTORY_SEPARATOR
            . basename($value);

        if (is_file($path)) {
            unlink($path);
        }
    }

    private function uploadToVercelBlob(
        string $filePath,
        string $pathname,
        string $mime,
        string $token
    ): string {
        $curl = curl_init(
            'https://vercel.com/api/blob/?pathname='
            . rawurlencode($pathname)
        );

        curl_setopt_array($curl, [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => file_get_contents($filePath),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
                'x-api-version: 12',
                'x-vercel-blob-access: public',
                'x-add-random-suffix: 1',
                'x-content-type: ' . $mime,
            ],
        ]);

        $response = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($response === false || $status < 200 || $status >= 300) {
            throw new RuntimeException(
                'Vercel Blob upload failed: '
                . ($error !== '' ? $error : (string) $response)
            );
        }

        $payload = json_decode((string) $response, true);

        if (! is_array($payload) || empty($payload['url'])) {
            throw new RuntimeException(
                'Vercel Blob returned an invalid response.'
            );
        }

        return (string) $payload['url'];
    }
}