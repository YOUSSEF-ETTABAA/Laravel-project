/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });

    }
    

});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-order").forEach((button) => {
        button.addEventListener("click", function () {
            const orderId = this.getAttribute("data-order-id");

            fetch(`/orders/${orderId}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    const orderItems = document.getElementById("orderItems");
                    orderItems.innerHTML = "";

                    data.items.forEach((item) => {
                        const tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>
                                <img src="${
                                    item.product.picture_path
                                }" alt="" class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body">${
                            item.product.name
                        }</a>
                            </td>
                            <td>${item.product.category.name}</td>
                            <td>${item.quantity}</td>
                            <td>$${item.product.price}</td>
                            <td>$${item.quantity * item.product.price}</td>
                        `;
                        orderItems.appendChild(tr);
                    });

                    document.getElementById(
                        "totalAmount"
                    ).textContent = `$${data.total_amount}`;
                })
                .catch((error) => {
                    console.error("Error fetching order details:", error);
                });
        });
    });
});