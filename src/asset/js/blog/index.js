document.addEventListener('DOMContentLoaded', function () {
    const placeTypeSelect = document.getElementById('placeType');
    const placeSortSelect = document.getElementById('placeSort');
    const blogContainer = document.querySelector('.card-container');
    let currentPostCount = 4;
  
    function fetchAllBlogs() {
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
      fetch(
        `../../../asset/php/post.process.php?type=all&detail=&start=${currentPostCount}`
      )
        .then((response) => response.json())
        .then((data) => {
          displayBlogs(data.slice(0, currentPostCount));
        })
        .catch((error) => console.error('Error fetching more blogs:', error));
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
      appendLoadMoreButton();
    }
  

function appendLoadMoreButton() {
    if (currentPostCount < blogCount) {
      const loadMoreButton = document.createElement('button');
      loadMoreButton.id = 'loadMoreButton';
      loadMoreButton.textContent = 'Load More';
      loadMoreButton.classList.add('orange-button'); // Add the CSS class
      blogContainer.appendChild(loadMoreButton);
      loadMoreButton.addEventListener('click', loadMoreBlogs);
    }
  }
  
  
    // Initial data fetch for the second dropdown based on the default/first value of the first dropdown
    let blogCount = 0;
    fetchAllBlogs().then((data) => (blogCount = data.length));
  
    // Event listener for changes in the first dropdown
    placeTypeSelect.addEventListener('change', fetchDataForSecondDropdown);
  
    // This function handles the search functionality.
    document.getElementById('searchButton').addEventListener('click', function () {
      const type = placeTypeSelect.value;
      const detail = placeSortSelect.value;
      const fetchUrl = `../../../asset/php/post.process.php?type=${type}&detail=${encodeURIComponent(
        detail
      )}`;
  
      // Fetch filtered blog data based on the selection
      fetch(fetchUrl)
        .then((response) => response.json())
        .then((data) => {
          displayBlogs(data.slice(0, currentPostCount));
        })
        .catch((error) => console.error('Error fetching filtered blogs:', error));
    });
  });