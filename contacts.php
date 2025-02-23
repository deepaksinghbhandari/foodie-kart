<?php include('header.php'); ?>

<!-- Contact Us Section -->
<section id="contact-us" class="py-5" style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center center; margin-top:-50px;">
  <div class="container">
    <h2 class="text-center mb-4" data-aos="fade-up" style="font-weight: 700; font-size: 2.8rem; color:#ff5722; text-transform: uppercase;">
      Get in Touch
    </h2>
    <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.25rem; color: white; max-width: 700px; margin: 0 auto; line-height: 1.8;">
      Have questions or feedback? Feel free to reach out to us. We're here to help and will respond as soon as possible.
    </p>

    <!-- Contact Form Section -->
    <div class="row">
      <div class="col-md-8 offset-md-2" data-aos="fade-up" data-aos-delay="400">
        <form id="contactForm" action="contact_process.php" method="POST" style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
          <div class="form-row">
            <div class="form-group col-md-6" style="margin-bottom: 15px;">
              <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required style="border-radius: 5px; border: 1px solid #ced4da; padding: 18px; font-size: 1.1rem; width: 100%;" aria-label="Full Name">
            </div>
            <div class="form-group col-md-6" style="margin-bottom: 15px;">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required style="border-radius: 5px; border: 1px solid #ced4da; padding: 18px; font-size: 1.1rem; width: 100%;" aria-label="Email Address">
            </div>
          </div>

          <div class="form-group">
            <label for="message" style="font-size: 1rem; color: #34495e; font-weight: 600;">Your Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required style="border-radius: 5px; border: 1px solid #ced4da; padding: 18px; font-size: 1.1rem;" aria-label="Message"></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px; margin-top:20px; padding: 12px; font-size: 1.125rem; background-color: #3498db; border: none; font-weight: 600; text-transform: uppercase;">
            Send Message
          </button>
        </form>
      </div>
    </div>

    <!-- Contact Details Section -->
    <div class="row mt-5">
      <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
        <h3 style="font-size: 1.8rem; color: #ff5722; font-weight: 600;">Our Location</h3>
        <p style="font-size: 1.1rem; color: white; line-height: 1.8;">Visit us at our office for assistance or inquiries. We’re happy to help!</p>
        <iframe src="https://www.google.com/maps/embed?pb=YOUR_GOOGLE_MAPS_EMBED_URL" width="100%" height="300" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy"></iframe>
      </div>

      <div class="col-md-6" data-aos="fade-left" data-aos-delay="700">
        <h3 style="font-size: 1.8rem; color: #ff5722; font-weight: 600;">Follow Us</h3>
        <p style="font-size: 1.1rem; color: white; line-height: 1.8;">Stay connected via our social channels for updates and news.</p>

        <div class="d-flex justify-content-center mt-3">
          <a href="https://www.facebook.com" target="_blank" style="font-size: 1.5rem; color: #3b5998; margin-right: 15px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.twitter.com" target="_blank" style="font-size: 1.5rem; color: #00acee; margin-right: 15px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com" target="_blank" style="font-size: 1.5rem; color: #e4405f; margin-right: 15px;" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com" target="_blank" style="font-size: 1.5rem; color: #0e76a8;" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>

<!-- Optional: AOS (animations on scroll) -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();

  // Handle the form submission and redirect after a message
  const contactForm = document.getElementById("contactForm");

  contactForm.onsubmit = function(event) {
    event.preventDefault(); // Prevent form submission

    // Show a thank-you alert
    alert("Thank you for contacting us! We will get back to you shortly.");

    // Redirect to index.php after a delay of 3 seconds
    setTimeout(function() {
      window.location.href = 'index.php'; // Redirect to index.php
    }, 3000); // 3-second delay
  };
</script>

<!-- FontAwesome Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Optional: Add hover effects for buttons -->
<style>
  .btn-primary:hover {
    background-color: #2980b9;
    color: white;
    cursor: pointer;
  }

  .fab:hover {
    transform: scale(1.1);
    transition: transform 0.3s;
  }
</style>
