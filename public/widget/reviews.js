document.addEventListener('DOMContentLoaded', function() {
    const userId = document.querySelector('.hot-bleep-widget').getAttribute('businessunit-id');
    const scriptElement = document.querySelector('script[src*="reviews.js"]');
    
    // Get the value of the data-full-url attribute
    const fullUrl = scriptElement.dataset.fullUrl;
    
    const apiUrl = `${fullUrl}/${userId}`;
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            
            const hotBleepContainer = document.createElement('div');
            hotBleepContainer.classList.add('hot-bleep-container');
            
            const hotBleepHeader = document.createElement('div');
            hotBleepHeader.classList.add('hot-bleep-header');
            hotBleepHeader.style.alignItems = 'end';
            hotBleepHeader.style.marginBottom = '5px';
            
            const hotBleepLogo = document.createElement('div');
            hotBleepLogo.classList.add('hot-bleep-logo');
            hotBleepLogo.style.marginRight = '10px';
            const logoImg = document.createElement('img');
            logoImg.src = data.logoUrl;
            logoImg.style.height = '56px';
            hotBleepLogo.appendChild(logoImg);
            
            const businessName = document.createElement('div');
            businessName.id = 'businessName';
            businessName.classList.add('hot_bleep_business-name');
            businessName.innerText = data.businessName;
            
            hotBleepHeader.appendChild(hotBleepLogo);
            hotBleepHeader.appendChild(businessName);
            hotBleepContainer.appendChild(hotBleepHeader);
            
            const hotBleepRating = document.createElement('div');
            hotBleepRating.classList.add('hot-bleep-rating');
            
            const hotBleepStars = document.createElement('div');
            hotBleepStars.classList.add('hot-bleep-stars');
            hotBleepStars.style.color = 'gold';
            hotBleepStars.style.fontSize = '31px';
            hotBleepStars.style.setProperty('--rating', data.averageRating);
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('span');
                star.classList.add('hot-bleep-star');
                star.style.marginRight = '5px';
                star.innerHTML = (i <= data.averageRating) ? '&#9733;' : '&#9734;';
                hotBleepStars.appendChild(star);
            }
            
            const hotBleepTrustscore = document.createElement('div');
            hotBleepTrustscore.classList.add('hot-bleep-trustscore');
            hotBleepTrustscore.style.fontSize = '16px';
            hotBleepTrustscore.innerHTML = `
                <span>TrustBank </span><span id="hot-bleep-score" style="font-weight:700;" class="hot-bleep-score">${data.averageRating}</span>
                 |  <span id="hot-bleep-total-reviews" class="hot-bleep-total-reviews">(${data.reviewsCount} reviews)</span>
            `;
            
            hotBleepRating.appendChild(hotBleepStars);
            hotBleepRating.appendChild(hotBleepTrustscore);
            
            hotBleepContainer.appendChild(hotBleepRating);
            
            const hotBleepWidget = document.querySelector('.hot-bleep-widget');
            hotBleepWidget.style.textAlign = 'center';

            hotBleepWidget.appendChild(hotBleepContainer);
        })
        .catch(error => {
            console.log('Error fetching reviews:', error);
        });
});
