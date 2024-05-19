var sitePlusMinus = function () {
    var value,
        quantityContainers = document.querySelectorAll(".quantity-container");

    function createBindings(quantityContainer) {
        var quantityAmount =
            quantityContainer.querySelector(".quantity-amount");
        var increase = quantityContainer.querySelector(".increase");
        var decrease = quantityContainer.querySelector(".decrease");

        increase.addEventListener("click", function (e) {
            increaseValue(e, quantityAmount);
            updateTotal(quantityContainer.closest("tr.product-row"));
            updateTotals(); // Update subtotal and total
        });
        decrease.addEventListener("click", function (e) {
            decreaseValue(e, quantityAmount);
            updateTotal(quantityContainer.closest("tr.product-row"));
            updateTotals(); // Update subtotal and total
        });

        // Add event listener for input event
        quantityAmount.addEventListener("input", function (e) {
            var newValue = parseInt(this.value);
            if (!isNaN(newValue) && newValue >= 0) {
                this.value = newValue;
                updateTotal(quantityContainer.closest("tr.product-row"));
                updateTotals(); // Update subtotal and total
            }
        });
    }

    function init() {
        for (var i = 0; i < quantityContainers.length; i++) {
            createBindings(quantityContainers[i]);
            updateTotal(quantityContainers[i].closest("tr.product-row"));
        }
        updateTotals(); // Update subtotal and total initially
    }

    function increaseValue(event, quantityAmount) {
        value = parseInt(quantityAmount.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        quantityAmount.value = value;
    }

    function decreaseValue(event, quantityAmount) {
        value = parseInt(quantityAmount.value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 0) value--;
        quantityAmount.value = value;
    }

    function updateTotal(productRow) {
        var price = parseFloat(
            productRow
                .querySelector(".product-price")
                .innerText.replace("$", "")
        );
        var quantity = parseInt(
            productRow.querySelector(".quantity-amount").value
        );
        var total = price * quantity;
        productRow.querySelector(".product-total").innerText =
            "$" + total.toFixed(2);
    }

    function updateTotals() {
        var subTotal = 0;
        var productRows = document.querySelectorAll("tr.product-row");
        productRows.forEach(function (row) {
            subTotal += parseFloat(
                row.querySelector(".product-total").innerText.replace("$", "")
            );
        });

        var taxRate = 0.05; // Assuming tax rate is 5%
        var total = subTotal * (1 + taxRate);

        document.querySelector(".subtotal").innerText =
            "$" + subTotal.toFixed(2);
        document.querySelector(".total").innerText = "$" + total.toFixed(2);

        // Update hidden input fields
        document.getElementById("subtotal").value = subTotal.toFixed(2);
        document.getElementById("total").value = total.toFixed(2);
    }

    init();
};

sitePlusMinus();
