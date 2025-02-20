<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Café Luxe</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .section-bg {
            padding: 80px 0;
            background: linear-gradient(to right,rgb(145, 135, 130),  #8f5f49);
            color: white;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .section-bg::before, .site-footer::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .section-bg::after, .site-footer::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .about-heading {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .about-text {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .about-image {
            width: 100%;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .about-image:hover {
            transform: scale(1.05);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Footer Styling */
        .site-footer {
            padding: 60px 0;
            background: linear-gradient(to right, #000000, #333333);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-top: 50px;
            border-radius: 10px 10px 0 0;
            box-shadow: 0px -4px 20px rgba(0, 0, 0, 0.2);
        }

        .site-footer-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .footer-link:hover {
            color: #f1c40f;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <section class="section-bg text-center">
            <div class="container fade-in">
                <h2 class="about-heading">About Café Luxe</h2>
                <p class="about-text">Café Luxe is more than just a coffee shop; it's an experience. We are dedicated to crafting the finest coffee using high-quality beans sourced from around the world. Whether you're here for a quick espresso, a relaxing afternoon with friends, or a cozy corner to work, our café offers a warm and inviting atmosphere.</p>
                <img src="https://source.unsplash.com/800x400/?coffee,cafe" class="about-image mt-4" alt="Cafe Image">
            </div>
        </section>
    </main>

    <?php include '../../includes/footer.php'; ?>

</body>
</html>
