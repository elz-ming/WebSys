document.addEventListener('DOMContentLoaded', function() {
  const placeTypeSelect = document.getElementById('placeType');
  const placeSortSelect = document.getElementById('placeSort');

  function fetchAllBlogs() {
    // Fetch all blog data when page loads
    const fetchUrl = `../../../asset/php/post.process.php?type=all&detail=`;
    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            const blogContainer = document.querySelector('.card-container');
            blogContainer.innerHTML = ''; // Clear existing blog cards

            // Construct new blog cards and add them to the page
            data.forEach(blog => {
                const cardHtml = `
                    <div class="col-4 card">
                        <img src="${blog.image_path}" alt="Blog Image">
                        <div class="card-content">
                            <h3><a href="/blog/post.php?blog_id=${blog.id}">${blog.title}</a></h3>
                            <p>${blog.subtitle}</p>
                            <p>By ${blog.first_name} ${blog.last_name} </p>
                        </div>
                    </div>
                `;
                blogContainer.innerHTML += cardHtml;
            });
        }).catch(error => console.error('Error fetching all blogs:', error));
  }

  // Function to handle changes in the first dropdown or initial load
  function fetchDataForSecondDropdown() {
    // Determine which file to use based on the selection
    let fetchUrl = '';
    switch (placeTypeSelect.value) {
        case 'country':
            fetchUrl = '../../../asset/php/getCountries.php';
            break;
        case 'category':
            fetchUrl = '../../../asset/php/getCategories.php';
            break;
    }

    // Fetch data and populate the second dropdown
    if (fetchUrl) {
        fetch(fetchUrl)
            .then(response => response.json())
            .then(data => {
                placeSortSelect.innerHTML = ''; // Clear existing options
                data.forEach(item => {
                    let option = new Option(item, item);
                    placeSortSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    } else {
        placeSortSelect.innerHTML = ''; // Clear the dropdown if 'all' is selected
    }
  }

  // Initial data fetch for the second dropdown based on the default/first value of the first dropdown
  fetchAllBlogs();
  fetchDataForSecondDropdown();

  // Event listener for changes in the first dropdown
  placeTypeSelect.addEventListener('change', fetchDataForSecondDropdown);

  // This function handles the search functionality.
  document.getElementById('searchButton').addEventListener('click', function() {
    const type = placeTypeSelect.value;
    const detail = placeSortSelect.value;
    const fetchUrl = `../../../asset/php/post.process.php?type=${type}&detail=${encodeURIComponent(detail)}`;

    // Fetch filtered blog data based on the selection
    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            const blogContainer = document.querySelector('.card-container');
            blogContainer.innerHTML = ''; // Clear existing blog cards

            // Construct new blog cards and add them to the page
            data.forEach(blog => {
                const cardHtml = `
                    <div class="col-4 card">
                        <img src="${blog.image_path}" alt="Blog Image">
                        <div class="card-content">
                            <h3><a href="/blog/post.php?blog_id=${blog.id}">${blog.title}</a></h3>
                            <p>${blog.subtitle}</p>
                            <p>By ${blog.first_name} ${blog.last_name} </p>
                        </div>
                    </div>
                `;
                blogContainer.innerHTML += cardHtml;
            });
        }).catch(error => console.error('Error fetching filtered blogs:', error));
  });
});