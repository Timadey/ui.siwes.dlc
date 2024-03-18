let currentPageIndex = 0;
let formPages = document.querySelectorAll('.form-page');
let prevBtn = document.getElementById('prev-btn');
let nextBtn = document.getElementById('next-btn');
let submitBtn = document.getElementById('submit-btn');
let footer = document.querySelector('.footer');
let width = window.innerWidth;



function showPage(index) {
  formPages.forEach((page, pageIndex) => {
    if (pageIndex === index) {
      page.style.display = 'flex';
    } else {
      page.style.display = 'none';
    }
  });

  if (index === 0) {
    prevBtn.style.visibility = "hidden"
  } else {
    prevBtn.style.visibility = 'visible';
  }

  if (index === formPages.length - 1) {
    nextBtn.style.display = 'none';
    submitBtn.style.display = 'block';
  } else {
    nextBtn.style.display = 'inline-block';
    submitBtn.style.display = 'none';
  }
  updateIndicators(index)
}

function nextPage() {
  if (currentPageIndex < formPages.length - 1) {
    currentPageIndex++;
    showPage(currentPageIndex);
  }
//   if(width>430){
//     // footer.style.display="none";
//     console.log ("Its marked")
//   }
//   else{
//     console.log(" It isnt marked")
//   }
//  footer.style.display="none"
}


function prevPage() {
  if (currentPageIndex > 0) {
    currentPageIndex--;
    showPage(currentPageIndex);
  }
// footer.style.display="none"
}


let indicators = document.querySelectorAll('.circ');

function updateIndicators(index) {
  indicators.forEach((indicator, indicatorIndex) => {
    if (indicatorIndex === index) {
      indicator.classList.add('active');
    } else {
      indicator.classList.remove('active');
    }
  });
}


// Attach onscroll event listener to each split form page
document.querySelectorAll('.form-page').forEach(function(page) {
page.onscroll = function() {
// Get the current scroll position of the page
let scrollPosition = page.scrollTop;

// Get the pagination element for this page
let pagination = page.querySelector('footer'); // Replace '.pagination' with the class of your pagination element for this page

// Show pagination if scroll position is at the bottom
if (scrollPosition + page.clientHeight >= page.scrollHeight) {
  pagination.style.display = 'flex';
} else {
  // Hide pagination if scroll position is not at the bottom
  pagination.style.display = 'none';
}
};
});

window.onload=function(){
  window.onscroll= function() {
    let scrollPosition= window.pageYOffset || document.documentElement.scrollTop;
    let documentHeight = document.documentElement.scrollHeight;
    let viewportHeight=window.innerHeight;
    let distance= documentHeight - (scrollPosition + viewportHeight);
    let threshold=50;
    
    if(distance >=threshold){
    footer.style.display="none";
    }
    
    else{
    footer.style.display="flex"
    }
    }
}

