const btnOpenmodal = document.querySelector('.btn-open');
const modalCalculator = document.querySelector('.modal-calculator');
const contentCalculator = document.querySelector('.content-calculator');

//Open Modal
btnOpenmodal.addEventListener('click',function(){
    modalCalculator.style.display = "block";
});

//Close Modal
// window.onclick = function(event) {
//     if (event.target == contentCal) {
//         contentCal.style.display = "none";
//     }
// }

const men = document.getElementById('men');
const women = document.getElementById('women');
// const result = document.getElementById('result')l

men.addEventListener('change',function(){
    var elem = document.getElementById("myBar");   
    var width = 0;
    var id = setInterval(frame, 20);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
      } else {
        width++; 
        elem.style.width = width + '%'; 
        document.getElementById('result').innerHTML = width * 1  + '%';
      }
    }
})

women.addEventListener('change',function(){
    console.log('5555');
})
