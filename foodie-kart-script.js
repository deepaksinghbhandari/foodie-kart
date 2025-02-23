// Show/Hide Login and Sign-Up Modals
const loginBtn = document.getElementById("loginBtn");
const signUpBtn = document.getElementById("signUpBtn");
const closeLogin = document.getElementById("closeLogin");
const closeSignUp = document.getElementById("closeSignUp");
const loginModal = document.getElementById("loginModal");
const signUpModal = document.getElementById("signUpModal");

// Open Modals
loginBtn.onclick = () => loginModal.style.display = "block";
signUpBtn.onclick = () => signUpModal.style.display = "block";

// Close Modals
closeLogin.onclick = () => loginModal.style.display = "none";
closeSignUp.onclick = () => signUpModal.style.display = "none";

// Close Modal if clicked outside
window.onclick = (event) => {
    if (event.target === loginModal) loginModal.style.display = "none";
    if (event.target === signUpModal) signUpModal.style.display = "none";
};

// Validate Forms
const validateForm = (form, emailSelector, passwordSelector, nameSelector) => {
    const email = document.querySelector(emailSelector).value;
    const password = document.querySelector(passwordSelector).value;
    const name = nameSelector ? document.querySelector(nameSelector).value : null;

    if (!email || !password || (nameSelector && !name)) {
        alert("All fields are required!");
        return false;
    }
    if (!validateEmail(email)) {
        alert("Please enter a valid email address!");
        return false;
    }
    return true;
};

// Validate Email
const validateEmail = (email) => /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email);

// Form Submit Events
document.getElementById("loginForm").addEventListener("submit", (event) => {
    if (!validateForm(event.target, "#loginEmail", "#loginPassword")) event.preventDefault();
});
document.getElementById("signUpForm").addEventListener("submit", (event) => {
    if (!validateForm(event.target, "#signUpEmail", "#signUpPassword", "#signUpName")) event.preventDefault();
});

// Date Validation
document.getElementById('date').addEventListener('input', function () {
    const dateInput = this.value;
    const currentDate = new Date();
    const maxDate = new Date(currentDate.setDate(currentDate.getDate() + 10));
    const currentDateStr = currentDate.toISOString().split('T')[0];
    const maxDateStr = maxDate.toISOString().split('T')[0];

    this.setAttribute('min', currentDateStr);
    this.setAttribute('max', maxDateStr);

    const dateError = document.getElementById('dateError');
    if (dateInput > maxDateStr) {
        dateError.style.display = 'block';
        dateError.textContent = 'Please select a date within 10 days from today.';
    } else {
        dateError.style.display = 'none';
    }
});

// Booking Form Validation
const validateBookingForm = (event) => {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const people = document.getElementById('people').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const timePattern = /^(0[6-9]|1[0-1]):[0-5][0-9] (AM|PM)$/;

    let formValid = true;

    if (!name.trim()) {
        formValid = false;
        alert("Please enter your name.");
    }
    if (!email.trim()) {
        formValid = false;
        alert("Please enter your email.");
    } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email)) {
        formValid = false;
        alert("Please enter a valid email.");
    }
    if (people < 1 || people > 10) {
        formValid = false;
        alert("Please enter a valid number of people (between 1 and 10).");
    }

    const currentDate = new Date();
    const maxDate = new Date(currentDate.setDate(currentDate.getDate() + 10));
    const maxDateStr = maxDate.toISOString().split('T')[0];

    if (date < currentDate.toISOString().split('T')[0] || date > maxDateStr) {
        formValid = false;
        alert("Please select a valid reservation date (within 10 days from today).");
    }
    if (!time.trim() || !timePattern.test(time)) {
        formValid = false;
        alert("Please enter a valid time in 12-hour format (e.g., 6:00 AM).");
    }

    if (!formValid) event.preventDefault();
};

// Attach validation to booking form
document.getElementById('bookingForm').addEventListener('submit', validateBookingForm);

// Add to Cart functionality
document.querySelectorAll('.add-to-cart').forEach((button) => {
    button.addEventListener('click', function () {
        const { id, name, price, quantity, image } = this.dataset;

        fetch('add_to_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `item_id=${id}&item_name=${name}&item_price=${price}&quantity=${quantity}&image_url=${image}`,
        })
        .then((response) => response.json())
        .then((data) => {
            alert(data.status === 'success' ? data.message : data.message);
        });
    });
});
