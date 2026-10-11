"use strict";

const body = document.body;
const openButton = document.querySelector("[data-sidebar-open]");
const closeTargets = document.querySelectorAll("[data-sidebar-close]");

openButton?.addEventListener("click", () => body.classList.add("sidebar-open"));
closeTargets.forEach((target) => target.addEventListener("click", () => body.classList.remove("sidebar-open")));

document.querySelectorAll("[data-confirm]").forEach((form) => {
    form.addEventListener("submit", (event) => {
        if (!window.confirm(form.dataset.confirm || "Are you sure?")) {
            event.preventDefault();
        }
    });
});

document.querySelectorAll("[data-password-toggle]").forEach((button) => {
    button.addEventListener("click", () => {
        const input = document.getElementById(button.dataset.passwordToggle);
        if (!input) return;
        const hidden = input.type === "password";
        input.type = hidden ? "text" : "password";
        button.textContent = hidden ? "Hide" : "Show";
    });
});

document.querySelectorAll("[data-image-input]").forEach((input) => {
    input.addEventListener("change", () => {
        const file = input.files?.[0];
        const preview = document.getElementById(input.dataset.imageInput);

        if (!file || !preview || !file.type.startsWith("image/")) return;

        const reader = new FileReader();
        reader.addEventListener("load", () => {
            preview.src = String(reader.result);
        });
        reader.readAsDataURL(file);
    });
});

document.querySelectorAll("[data-search-input]").forEach((input) => {
    const container = document.getElementById(input.dataset.searchInput);
    if (!container) return;

    input.addEventListener("input", () => {
        const query = input.value.trim().toLowerCase();
        container.querySelectorAll("[data-search-item]").forEach((item) => {
            item.hidden = !String(item.dataset.searchItem).includes(query);
        });
    });
});

const productSelect = document.getElementById("saleProduct");
const customerSelect = document.getElementById("saleCustomer");
const quantityInput = document.getElementById("saleQuantity");

function peso(value) {
    return new Intl.NumberFormat("en-PH", { style: "currency", currency: "PHP" }).format(Number(value || 0));
}

function updateSaleSummary() {
    if (!productSelect || !quantityInput) return;

    const option = productSelect.options[productSelect.selectedIndex];
    const quantity = Math.max(1, Number(quantityInput.value || 1));
    const price = Number(option?.dataset.price || 0);
    const stock = Number(option?.dataset.stock || 0);
    const setText = (id, value) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    };

    setText("summaryName", option?.dataset.name || "Select a furniture piece");
    setText("summaryPrice", peso(price));
    setText("summaryQuantity", String(quantity));
    setText("summaryTotal", peso(price * quantity));
    setText("saleStockHint", option?.value ? `${stock} unit(s) currently available.` : "Select a product to view available stock.");

    const summaryImage = document.getElementById("summaryImage");
    if (summaryImage) summaryImage.src = option?.dataset.image || "/images/product-placeholder.svg";

    quantityInput.max = stock > 0 ? String(stock) : "";
    const customer = customerSelect?.options[customerSelect.selectedIndex]?.text || "Walk-in customer";
    setText("summaryCustomer", customer);
}

[productSelect, customerSelect, quantityInput].forEach((element) => element?.addEventListener("change", updateSaleSummary));
quantityInput?.addEventListener("input", updateSaleSummary);
updateSaleSummary();
```
