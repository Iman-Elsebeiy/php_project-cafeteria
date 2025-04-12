<footer class="mt-5 py-5">
    <div class="container">
        <div class="row g-4">
            <!-- About Section -->
            <div class="col-12 col-md-4">
                <h4 class="mb-4 text-bage">Cafeteria</h4>
                <p class="text-muted">Freshly brewed coffee, handcrafted sandwiches, and delicious pastries made with
                    the finest ingredients. Enjoy every bite with rich flavors and a warm, inviting experience.</p>
                <div class="social-links mt-3">
                    <a href="#" class="me-3"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="me-3"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="me-3"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-12 col-md-4">
                <h4 class="mb-4 text-bage">Quick Links</h4>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="/PHP-Project/php_project-cafeteria/users/views/user-home.php">Home</a>
                    </li>
                    <li class="mb-2"><a
                            href="/PHP-Project/php_project-cafeteria/users/views/user-home.php#products">Menu</a></li>
                    <li class="mb-2"><a href="/PHP-Project/php_project-cafeteria/users/views/about.php">About Us</a>
                    </li>
                    <li class="mb-2"><a href="/PHP-Project/php_project-cafeteria/users/views/contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Search Section -->
            <div class="col-12 col-md-4">
                <h4 class="mb-4 text-bage">Search Products</h4>
                <form action="/PHP-Project/php_project-cafeteria/users/views/user-home.php#products" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control p-2" name="search" placeholder="Search for products..."
                            aria-label="Search for products">
                        <button class="btn search-btn" type="submit">
                            Search
                        </button>
                    </div>
                </form>
                <div class="contact-info mt-4">
                    <p class="mb-2"><i class="fas fa-phone-alt me-2"></i> +20 114 802 8020</p>
                    <p class="mb-2"><i class="fas fa-envelope me-2"></i> cafeteria@email.com</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> 123 Coffee Street, Cairo, Egypt</p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-5">
            <div class="col-12">
                <hr class="opacity-25">
                <p class="text-center text-muted mb-0">© <?php echo date('Y'); ?> Cafeteria. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>