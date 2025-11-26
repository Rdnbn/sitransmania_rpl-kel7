/* ============================================================
   FILE  : script.js
   GLOBAL JS untuk seluruh aplikasi SITRANSMANIA
   CATATAN: Ada bagian yang perlu disesuaikan di bawah
   ============================================================ */

/* -----------------------------------------
   1. Toggle Sidebar (Untuk Layout Admin)
   ----------------------------------------- */
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector("#toggleSidebar");
    const sidebar = document.querySelector("#sidebar");

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("sidebar-active");
        });
    }
});

/* -----------------------------------------
   2. Smooth Scroll Untuk Navigasi
   ----------------------------------------- */
document.querySelectorAll("a[href^='#']").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        const target = document.querySelector(this.getAttribute("href"));

        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

/* -----------------------------------------
   3. Global Loading Spinner
   ----------------------------------------- */
function showLoading() {
    let loader = document.querySelector("#loadingOverlay");
    if (loader) loader.style.display = "flex";
}

function hideLoading() {
    let loader = document.querySelector("#loadingOverlay");
    if (loader) loader.style.display = "none";
}

/* -----------------------------------------
   4. Helper Fetch API (umum)
   ----------------------------------------- */
async function apiRequest(url, method = "GET", data = null) {
    showLoading();

    let options = {
        method: method,
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    };

    if (data) {
        options.body = JSON.stringify(data);
    }

    try {
        let res = await fetch(url, options);
        let json = await res.json();
        hideLoading();
        return json;
    } catch (error) {
        hideLoading();
        console.error("API Error:", error);
        return null;
    }
}

/* -----------------------------------------
   5. Toast Notification (UI Pesan)
   ----------------------------------------- */
function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("show");
    }, 100);

    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

/* -----------------------------------------
   6. Auto-hide Navbar saat scroll (opsional)
   ----------------------------------------- */
let lastScrollTop = 0;
const navbar = document.querySelector("nav");

if (navbar) {
    window.addEventListener("scroll", function () {
        let current = window.pageYOffset || document.documentElement.scrollTop;

        if (current > lastScrollTop) {
            navbar.style.top = "-80px"; // sembunyi
        } else {
            navbar.style.top = "0"; // munculkan
        }
        lastScrollTop = current <= 0 ? 0 : current;
    });
}

/* -----------------------------------------
   7. Placeholder untuk fitur Live Map
   ----------------------------------------- */
/*
   Di livemap.js nanti, kamu akan:
   - Inisialisasi map
   - Masukkan API key Mapbox / Leaflet
   - Update marker posisi kendaraan
   - Fetch data koordinat dari backend

   Jangan taruh di script.js supaya rapi.
*/

/* -----------------------------------------
   8. CONFIG YANG PERLU DISESUAIKAN (PENTING)
   ----------------------------------------- */
// Ganti sesuai base URL website-mu
const BASE_API_URL = "http://localhost:8000/api"; // SESUAIKAN NANTI

/*
   Jika nanti backendmu pakai route lain:
   - /api/vehicles
   - /api/locations
   - /api/user-position

   kamu tinggal panggil:
   apiRequest(`${BASE_API_URL}/vehicles`)
*/
