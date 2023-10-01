// JavaScript for smooth page transition
const pageLinks = document.querySelectorAll('.page-link');

function navigateToPage(event) {
    event.preventDefault(); // Prevent the default navigation behavior

    document.body.classList.add('hidden'); // Apply the transition effect

    // Get the href attribute of the clicked link and navigate to the new page
    const targetPage = event.target.getAttribute('href');
    
    // Wait for the transition to complete and then navigate to the new page
    setTimeout(function() {
        window.location.href = targetPage;
    }, 500); // Adjust the timeout to match your transition duration
}

// Add a click event listener to each page link
pageLinks.forEach(link => {
    link.addEventListener('click', navigateToPage);
});
