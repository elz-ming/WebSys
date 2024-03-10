<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Project</title>
    <style>
      body,
      html {
        height: 100%;
        margin: 0;
        overflow-x: hidden;
        /* Prevent horizontal scrolling */
      }

      .div {
        background-image: url('https://upload.wikimedia.org/wikipedia/commons/1/15/Travel_%288274728646%29.jpg');
        /* Replace 'path/to/your/image.jpg' with the path to your background image */
        background-size: cover;
        /* Ensure the background image covers the entire element */
        background-position: center;
        /* Center the background image */
        position: relative;
        display: flex;
        /* width: 100%; */
        /* max-width: 1920px; */
        /* Set maximum width */
        flex-direction: column;
        align-items: center;
        padding: 25px 60px 80px;
        overflow: hidden;
        /* Prevent scrolling of the main content */
        margin-left: auto; /* Center horizontally */
        margin-right: auto; /* Center horizontally */
      }

      @media (max-width: 1459px) {
        .div {
          padding: 0 20px;
        }
      }

      .div-2 {
        display: flex;
        margin-bottom: 118px;
        width: 1172px;
        max-width: 100%;
        flex-direction: column;
        align-items: center;
      }

      .div-3 {
        align-self: stretch;
        display: flex;
        width: 100%;
        justify-content: space-between;
        gap: 20px;
        padding: 0 1px;
      }

      @media (max-width: 991px) {
        .div-3 {
          max-width: 100%;
          flex-wrap: wrap;
        }
      }

      .div-4 {
        display: flex;
        justify-content: space-between;
        gap: 20px;
      }

      @media (max-width: 991px) {
        .div-4 {
          max-width: 100%;
          flex-wrap: wrap;
        }
      }

      .div-5 {
        color: #fff;
        align-self: start;
        margin-top: 14px;
        flex-grow: 1;
        flex-basis: auto;
        font: 700 36px Poppins, sans-serif;
      }

      .div-6 {
        border-radius: 30px;
        background-color: #fff;
        display: flex;
        gap: 17px;
        font-size: 18px;
        color: #868383;
        font-weight: 300;
        padding: 15px 24px;
        margin-left: 123px;
        /* Adjust margin to position it 123px away from the logo */
        width: 554px;
        /* Set width to 554px */
      }


      @media (max-width: 991px) {
        .div-6 {
          flex-wrap: wrap;
          padding: 0 20px;
        }
      }

      .img {
        aspect-ratio: 1;
        object-fit: auto;
        object-position: center;
        width: 24px;
      }

      .div-7 {
        font-family: Poppins, sans-serif;
        flex-grow: 1;
        flex-basis: auto;
      }

      @media (max-width: 991px) {
        .div-7 {
          max-width: 100%;
        }
      }

      .img-2 {
        aspect-ratio: 1;
        object-fit: auto;
        object-position: center;
        width: 36px;
        margin: auto 0;
      }

      .div-8 {
        border-color: rgba(255, 255, 255, 0.6);
        border-style: solid;
        border-width: 1px;
        background-color: rgba(255, 255, 255, 0.6);
        align-self: stretch;
        margin-top: 21px;
        height: 1px;
      }

      @media (max-width: 991px) {
        .div-8 {
          max-width: 100%;
        }
      }

      .div-9 {
        display: flex;
        margin-top: 25px;
        width: 789px;
        max-width: 100%;
        justify-content: space-between;
        gap: 20px;
        font-size: 20px;
        color: #fff;
        font-weight: 400;
        white-space: nowrap;
      }

      @media (max-width: 991px) {
        .div-9 {
          flex-wrap: wrap;
          white-space: initial;
        }
      }

      .div-10 {
        display: flex;
        gap: 3px;
      }

      @media (max-width: 991px) {
        .div-10 {
          white-space: initial;
        }
      }

      .div-11 {
        font-family: Poppins, sans-serif;
        flex-grow: 1;
        margin: auto 0;
      }

      .div-12 {
        display: flex;
        gap: 1px;
      }

      @media (max-width: 991px) {
        .div-12 {
          white-space: initial;
        }
      }

      .div-13 {
        font-family: Poppins, sans-serif;
        flex-grow: 1;
        margin: auto 0;
      }

      .div-14 {
        display: flex;
        gap: 7px;
      }

      @media (max-width: 991px) {
        .div-14 {
          white-space: initial;
        }
      }

      .div-15 {
        font-family: Poppins, sans-serif;
        flex-grow: 1;
        margin: auto 0;
      }

      @media (max-width: 991px) {
        .div-15 {
          white-space: initial;
        }
      }

      .div-16 {
        display: flex;
        gap: 4px;
      }

      @media (max-width: 991px) {
        .div-16 {
          white-space: initial;
        }
      }

      .div-17 {
        font-family: Poppins, sans-serif;
        flex-grow: 1;
      }

      .div-18 {
        display: flex;
        gap: 7px;
      }

      @media (max-width: 991px) {
        .div-18 {
          white-space: initial;
        }
      }

      .div-19 {
        font-family: Poppins, sans-serif;
        flex-grow: 1;
        margin: auto 0;
      }

      @media (max-width: 991px) {
        .div-19 {
          white-space: initial;
        }
      }

      .div-20 {
        color: #fff;
        margin-top: 249px;
        font: 700 75px Poppins, sans-serif;
      }

      @media (max-width: 991px) {
        .div-20 {
          max-width: 100%;
          margin-top: 40px;
          font-size: 40px;
        }
      }

      .div-21 {
        color: #fff;
        text-align: center;
        margin-top: 46px;
        font: 400 15px/29px Poppins, sans-serif;
      }

      @media (max-width: 991px) {
        .div-21 {
          max-width: 100%;
          margin-top: 40px;
        }
      }

      .div-22 {
        color: #ffa902;
        margin-top: 78px;
        white-space: nowrap;
        font: 700 36px/196.3% Poppins, sans-serif;
      }

      @media (max-width: 991px) {
        .div-22 {
          max-width: 100%;
          margin-top: 40px;
          font-size: 30px;
        }
      }

      .div-category {
        color: #141414;
        text-transform: capitalize;
        width: 355px;
        height: 54px;
        white-space: nowrap;
        font: 600 36px Poppins, sans-serif;
        text-align: center;
        position: absolute;
        top: 1050px;
        /* Position 1050px from the top */
        bottom: 5504px;
        /* Position 5504px from the bottom */
        left: 264px;
        /* Position 264px from the left */
        right: 264px;
        /* Position 264px from the right */
        margin: auto;
        /* Center horizontally */
      }

      .div-category-container {
        width: 1390px;
        height: 393px;
        position: absolute;
        top: 1104px;
        /* Adjust top position based on the space between "choose a category" and the block */
        bottom: 5070px;
        /* Adjust bottom position based on the space between the block and the bottom of the webpage */
        left: 264px;
        /* Position 264px from the left */
        right: 264px;
        /* Position 264px from the right */
        margin: auto;
        /* Center horizontally */
      }

      @media (max-width: 991px) {
        .div-category {
          margin-top: 40px;
          white-space: initial;
        }
      }
    </style>
  </head>

  <body>
    <main>
      <div class="div">
        <div class="div-2">
          <div class="div-3">
            <div class="div-4">
              <div class="div-5">Company</div>
              <div class="div-6">
                <img loading="lazy"
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/7cba948ec0c26dda3fdb039aaeea35c6a5ca4402d398ddb3406a66da8fb103d9?"
                  class="img">
                <div class="div-7">Search your option</div>
              </div>
            </div>
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/c46f9b9d92168719d0506204eef18fa03bfb103d500ce51d38f18f1f41fe3b2b?"
              class="img-2">
          </div>
          <div class="div-8"></div>
          <div class="div-9">
            <div class="div-10">
              <div class="div-11">Home</div>
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/ab08d7ed9972fa8d838ac52d8b3d4d5526f87c6f5303244fcb33039b917470ba?"
                class="img">
            </div>
            <div class="div-12">
              <div class="div-13">Destinations</div>
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/990e575cbff700e6d365e5f21408dd5b93b77088e3219f91f91dacf8fc4288b4?"
                class="img">
            </div>
            <div class="div-14">
              <div class="div-15">About Us</div>
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/990e575cbff700e6d365e5f21408dd5b93b77088e3219f91f91dacf8fc4288b4?"
                class="img">
            </div>
            <div class="div-16">
              <div class="div-17">Blog</div>
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/990e575cbff700e6d365e5f21408dd5b93b77088e3219f91f91dacf8fc4288b4?"
                class="img">
            </div>
            <div class="div-18">
              <div class="div-19">Contact Us</div>
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/ab08d7ed9972fa8d838ac52d8b3d4d5526f87c6f5303244fcb33039b917470ba?"
                class="img">
            </div>
          </div>
          <div class="div-20">Where will you go next?</div>
          <div class="div-21">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo velit, eu
            sed sollicitudin tempus, risus. Sed sit elit mauris adipiscing. Lobortis pellentesque nulla accumsan id urna,
            ullamcorper gravida varius. Massa mauris, cursus orci magna non enim fames et sed.
          </div>
          <div class="div-22">Let’s Go.....</div>
        </div>
      </div>

      <div class="div-category">Choose a category</div>
    </main>
  </body>
</html>