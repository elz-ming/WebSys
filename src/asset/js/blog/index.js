document.addEventListener('DOMContentLoaded', function() {
    const placeTypeSelect = document.getElementById('placeType');
    const placeSortSelect = document.getElementById('placeSort');
    const blogContainer = document.querySelector('.card-container');
    
    let currentPostCount = 4;
    
    function fetchAllBlogs() {
      // Fetch all blog data when page loads
      const fetchUrl = `../../../asset/php/post.process.php?type=all&detail=`;
      fetch(fetchUrl)
          .then((response) => response.json())
          .then((data) => {
            blogCount = data.length;
            displayBlogs(data.slice(0, currentPostCount));
          })
          .catch((error) => console.error('Error fetching all blogs:', error));
      }
      function loadMoreBlogs() {
        currentPostCount += 2;
        const type = placeTypeSelect.value;
        const detail = placeSortSelect.value;
        fetch(
          `../../../asset/php/post.process.php?type=${type}&detail=${encodeURIComponent(
            detail
          )}&start=${currentPostCount}`
        )
          .then((response) => response.json())
          .then((data) => {
            displayBlogs(data.slice(0, currentPostCount));
          })
          .catch((error) => console.error('Error fetching more blogs:', error));
      }
    
      function addLoadMoreButton() {
        if (blogCount > currentPostCount) {
          const loadMoreButton = document.createElement('button');
          loadMoreButton.id = 'loadMoreButton';
          loadMoreButton.textContent = 'Load More';
          loadMoreButton.classList.add('orange-button');
          blogContainer.appendChild(loadMoreButton);
          loadMoreButton.addEventListener('click', loadMoreBlogs);
        }
      }
      
      function displayBlogs(blogs) {
        blogContainer.innerHTML = '';
        blogs.forEach((blog) => {
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
      
        addLoadMoreButton();
      }
      
  
    // Function to handle changes in the first dropdown or initial load
    function fetchDataForSecondDropdown() {
      // Determine which file to use based on the selection
      let fetchUrl = '';
      switch (placeTypeSelect.value) {
          case 'country':
              fetchUrl = '/asset/php/getCountries.php';
              break;
          case 'category':
              fetchUrl = '/asset/php/getCategories.php';
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
        currentPostCount = 4;
        fetch(
          `../../../asset/php/post.process.php?type=${type}&detail=${encodeURIComponent(
            detail
          )}`
        )
          .then(response => response.json())
          .then(data => {
            // Clear existing blog cards
            const blogContainer = document.querySelector('.card-container');
            blogContainer.innerHTML = '';
      
            // Construct new blog cards based on the filtered data
            displayBlogs(data.slice(0, currentPostCount));
      
            // Update the blog count
            blogCount = data.length;
      
            // Remove the existing "Load More" button
            const existingLoadMoreButton = document.getElementById('loadMoreButton');
            if (existingLoadMoreButton) {
              blogContainer.removeChild(existingLoadMoreButton);
            }
      
            // Ensure that the first 4 cards are displayed and the "Load More" button is added
            addLoadMoreButton();
          })
          .catch(error => console.error('Error fetching filtered blogs:', error));
      });
  });