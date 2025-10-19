// Show/Hide Login and Sign-Up Modals
const loginBtn = document.getElementById("loginBtn") || document.getElementById("login-btn");
const signUpBtn = document.getElementById("signUpBtn") || document.getElementById("sign-up-btn");
const closeLogin = document.getElementById("closeLogin");
const closeSignUp = document.getElementById("closeSignUp");
const loginModal = document.getElementById("loginModal");
const signUpModal = document.getElementById("signUpModal");
const hasBootstrapModal =
  typeof window !== "undefined" &&
  typeof window.bootstrap !== "undefined" &&
  typeof window.bootstrap.Modal === "function";

// Open Modals
if (loginBtn && loginModal) {
  if (hasBootstrapModal) {
    const loginBsModal = window.bootstrap.Modal.getOrCreateInstance(loginModal);
    loginBtn.onclick = () => loginBsModal.show();
  } else {
    loginBtn.onclick = () => (loginModal.style.display = "block");
  }
}
if (signUpBtn && signUpModal) {
  if (hasBootstrapModal) {
    const signUpBsModal = window.bootstrap.Modal.getOrCreateInstance(signUpModal);
    signUpBtn.onclick = () => signUpBsModal.show();
  } else {
    signUpBtn.onclick = () => (signUpModal.style.display = "block");
  }
}

// Close Modals
if (closeLogin && loginModal) {
  if (hasBootstrapModal) {
    const loginBsModal = window.bootstrap.Modal.getOrCreateInstance(loginModal);
    closeLogin.onclick = () => loginBsModal.hide();
  } else {
    closeLogin.onclick = () => (loginModal.style.display = "none");
  }
}
if (closeSignUp && signUpModal) {
  if (hasBootstrapModal) {
    const signUpBsModal = window.bootstrap.Modal.getOrCreateInstance(signUpModal);
    closeSignUp.onclick = () => signUpBsModal.hide();
  } else {
    closeSignUp.onclick = () => (signUpModal.style.display = "none");
  }
}

// Close Modal if clicked outside (fallback only; Bootstrap handles this natively)
window.onclick = (event) => {
  if (!hasBootstrapModal) {
    if (loginModal && event.target === loginModal) loginModal.style.display = "none";
    if (signUpModal && event.target === signUpModal) signUpModal.style.display = "none";
  }
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
const loginForm = document.getElementById("loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const emailSelector = document.querySelector("#loginEmail") ? "#loginEmail" : "#email";
        const passwordSelector = document.querySelector("#loginPassword") ? "#loginPassword" : "#password";

        if (!validateForm(event.target, emailSelector, passwordSelector)) return;

        const email = document.querySelector(emailSelector).value;
        const password = document.querySelector(passwordSelector).value;
        const messageBox = document.getElementById("loginMessage");

        try {
            const response = await fetch(
                `http://localhost:8080/api/login?email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
                { method: "POST" }
            );

            const text = await response.text();
            if (messageBox) {
                if (text.includes("Successful")) {
                    messageBox.innerHTML = `<span class="text-success">✅ ${text}</span>`;
                } else {
                    messageBox.innerHTML = `<span class="text-danger">❌ ${text}</span>`;
                }
            } else {
                alert(text);
            }
        } catch (err) {
            if (messageBox) {
                messageBox.innerHTML = `<span class="text-danger">⚠️ Server error: ${err.message}</span>`;
            } else {
                alert(`Server error: ${err.message}`);
            }
        }
    });
}

const signUpForm = document.getElementById("signUpForm");
if (signUpForm) {
    signUpForm.addEventListener("submit", (event) => {
        if (!validateForm(event.target, "#signUpEmail", "#signUpPassword", "#signUpName")) event.preventDefault();
    });
}

// Date Validation
const dateInputEl = document.getElementById('date');
if (dateInputEl) {
  dateInputEl.addEventListener('input', function () {
    const selectedDateStr = this.value;

    const today = new Date();
    const maxDate = new Date(today);
    maxDate.setDate(today.getDate() + 10);

    const todayStr = today.toISOString().split('T')[0];
    const maxDateStr = maxDate.toISOString().split('T')[0];

    this.setAttribute('min', todayStr);
    this.setAttribute('max', maxDateStr);

    const dateError = document.getElementById('dateError');
    if (!dateError) return;

    if (selectedDateStr < todayStr || selectedDateStr > maxDateStr) {
      dateError.style.display = 'block';
      dateError.textContent = 'Please select a date within 10 days from today.';
    } else {
      dateError.style.display = 'none';
    }
  });
}

// Booking Form Validation
const validateBookingForm = (event) => {
  const nameValue = (document.getElementById('name')?.value || '').trim();
  const emailValue = (document.getElementById('email')?.value || '').trim();
  const peopleValue = parseInt(document.getElementById('people')?.value || '0', 10);
  const dateValue = document.getElementById('date')?.value || '';
  const timeValue = (document.getElementById('time')?.value || '').trim();

  // Accept 6:00-11:59 AM/PM, with optional leading zero for hour
  const timePattern = /^([0]?[6-9]|1[0-1]):[0-5][0-9] (AM|PM)$/;

  let formValid = true;

  if (!nameValue) {
    formValid = false;
    alert("Please enter your name.");
  }

  if (!emailValue) {
    formValid = false;
    alert("Please enter your email.");
  } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(emailValue)) {
    formValid = false;
    alert("Please enter a valid email.");
  }

  if (Number.isNaN(peopleValue) || peopleValue < 1 || peopleValue > 10) {
    formValid = false;
    alert("Please enter a valid number of people (between 1 and 10).");
  }

  const today = new Date();
  const maxDate = new Date(today);
  maxDate.setDate(today.getDate() + 10);
  const todayStr = today.toISOString().split('T')[0];
  const maxDateStr = maxDate.toISOString().split('T')[0];

  if (!dateValue || dateValue < todayStr || dateValue > maxDateStr) {
    formValid = false;
    alert("Please select a valid reservation date (within 10 days from today).");
  }

  if (!timeValue || !timePattern.test(timeValue)) {
    formValid = false;
    alert("Please enter a valid time in 12-hour format (e.g., 6:00 AM).");
  }

  if (!formValid) event.preventDefault();
};

// Attach validation to booking form
const bookingForm = document.getElementById('bookingForm');
if (bookingForm) {
  bookingForm.addEventListener('submit', validateBookingForm);
}

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
