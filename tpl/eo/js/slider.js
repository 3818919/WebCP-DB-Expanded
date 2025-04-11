document.addEventListener("DOMContentLoaded", function () {
    const slideshow = document.getElementById("slideshow");
    const slideshowContainer = document.querySelector(".slideshow-container");
    const lightbox = document.createElement("div");
    const lightboxImage = document.createElement("img");
    const closeLightbox = document.createElement("span");

    // Initialize lightbox elements
    lightbox.className = "lightbox";
    lightboxImage.className = "lightbox-content";
    closeLightbox.className = "close";
    closeLightbox.innerHTML = "&times;";
    lightbox.appendChild(closeLightbox);
    lightbox.appendChild(lightboxImage);
    document.body.appendChild(lightbox);

    let currentIndex = 0;
    let images = [];
    const screenshotsFolder = "screenshots/";

    // Fetch images from the screenshots directory
    async function fetchImages() {
        try {
            const response = await fetch(screenshotsFolder);
            if (!response.ok) {
                slideshowContainer.style.display = "none";
                return;
            }

            const text = await response.text();

            // Parse the directory listing
            const parser = new DOMParser();
            const doc = parser.parseFromString(text, "text/html");
            const links = Array.from(doc.querySelectorAll("a"));

            // Filter for image files
            images = links
                .map((link) => link.getAttribute("href"))
                .filter((href) => /\.(jpg|jpeg|png|gif|bmp)$/i.test(href))
                .map((filename) => `${screenshotsFolder}${filename}`);

            if (images.length > 0) {
                createSlideshow(images);
                startSlideshow();
            } else {
                slideshowContainer.style.display = "none";
            }
        } catch (error) {
            slideshowContainer.style.display = "none";
        }
    }

    // Create slideshow elements
    function createSlideshow(images) {
        images.forEach((src, index) => {
            const img = document.createElement("img");
            img.src = src;
            img.alt = `Screenshot ${index + 1}`;
            img.style.opacity = index === 0 ? "1" : "0";
            img.addEventListener("click", () => openLightbox(src));
            slideshow.appendChild(img);
        });
    }

    // Start the slideshow
    function startSlideshow() {
        setInterval(() => {
            const slides = slideshow.querySelectorAll("img");
            slides[currentIndex].style.opacity = "0";
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].style.opacity = "1";
        }, 3000);
    }

    // Open lightbox
    function openLightbox(src) {
        lightbox.style.display = "block";
        lightboxImage.src = src;
    }

    // Close lightbox
    closeLightbox.addEventListener("click", () => {
        lightbox.style.display = "none";
    });

    // Close lightbox on outside click
    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            lightbox.style.display = "none";
        }
    });

    // Fetch images on page load
    fetchImages();
});