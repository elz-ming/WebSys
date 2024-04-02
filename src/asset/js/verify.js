//DOM load event
window.addEventListener("DOMContentLoaded",	() => {
	
	const cube = document.querySelector(".cube"),
		  imageButtons = document.querySelector(".image-buttons");
	let cubeImageClass = cube.classList[1];

	//Add click event listener to image buttons container
	imageButtons.addEventListener("click", e => {
		
		//Get node type and class value of clicked element
		const targetNode = e.target.nodeName,
			  targetClass = e.target.className;

		//Check if image input has been clicked and isn't the currently shown image
		if (targetNode === "INPUT" && targetClass !== cubeImageClass) {
			
			console.log(`Show Image: ${targetClass.charAt(11)}`);

			//Replace previous cube image class with new class
			cube.classList.replace(cubeImageClass, targetClass);

			//Update cube image class variable with new class
			cubeImageClass = targetClass;	
			
		}
		
	});
	
});

document.addEventListener("DOMContentLoaded", function() {
    const backgroundImages = {
        "show-image-1": "url('https://source.unsplash.com/man-in-swimming-pool-during-daytime-IzP7jvgwXo0/1920x1080')",
        "show-image-2": "url('https://source.unsplash.com/woman-in-red-and-orange-sweater-stands-on-stone-beside-water-JQ0YTMFhN5Q/1920x1080')",
		"show-image-3": "url('https://source.unsplash.com/a-narrow-city-street-at-night-with-neon-lights-QXJCo9sSd20/1920x1080')",
		"show-image-4": "url('https://source.unsplash.com/a-man-and-a-woman-standing-next-to-each-other-in-front-of-a-building-lSXYLGMQDSo/1920x1080')",
		"show-image-5": "url('https://source.unsplash.com/a-tree-that-is-standing-in-the-water-bCwYbTmixiw/1920x1080')",
		"show-image-6": "url('https://source.unsplash.com/a-blue-lake-surrounded-by-trees-in-the-middle-of-a-forest-sPWA29VTgLk/1920x1080')",
    };

    function changeBackgroundImage(imageId) {
        // Change the background image of the body
        document.body.style.backgroundImage = backgroundImages[imageId];
    }

    // Attach event listeners to buttons
    document.querySelectorAll('.image-buttons input').forEach(button => {
        button.addEventListener('click', function() {
            changeBackgroundImage(this.className);
        });
    });
});

function changeBackgroundImage(imageClassName) {
    const imageUrl = backgroundImages[imageClassName];
    if (imageUrl) {
        // Fade out effect
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease-in-out';
        
        // Allow time for the fade out effect to complete before changing the background and fading back in
        setTimeout(() => {
            document.body.style.backgroundImage = imageUrl;
            document.body.style.opacity = '1';
        }, 500); // Match the timeout to the transition duration
    } else {
        console.error("No background image found for class name:", imageClassName);
    }
}