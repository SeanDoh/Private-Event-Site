document.addEventListener('DOMContentLoaded', function () {
  
  document.getElementById('PlusOneInfo').style.display = 'none';
  document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoice_Holder').style.display = 'none';
  document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergies_Holder').style.display = 'none';
  document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoicePlusOne_Holder').style.display = 'none';
  document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergiesPlusOne_Holder').style.display = 'none';
  document.getElementById('RecaptchaForm_EventRegistrationForm_Attendance_Friday').addEventListener('click', showFood);
  document.getElementById('RecaptchaForm_EventRegistrationForm_AttendancePlusOne_Friday').addEventListener('click', showFood);
  document.getElementById('RecaptchaForm_EventRegistrationForm_PlusOne_1').addEventListener('click', showPlusOne);
})

function showFood(el){
  let foodChoice;
  let foodAllergy;
  let checkbox;
  let allergyTextarea;
  if(el.target.id === 'RecaptchaForm_EventRegistrationForm_Attendance_Friday'){
    foodChoice = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoice_Holder');
    foodAllergy = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergies_Holder');
    checkbox = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoice');
    allergyTextarea = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergies');
  }
  else if (el.target.id === 'RecaptchaForm_EventRegistrationForm_AttendancePlusOne_Friday'){
    foodChoice = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoicePlusOne_Holder');
    foodAllergy = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergiesPlusOne_Holder');
    checkbox = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoicePlusOne');
    allergyTextarea = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergiesPlusOne');
  }
  
  // show
  if(foodChoice.style.display === 'none' && foodAllergy.style.display === 'none'){
    foodChoice.style.display = 'flex';
    foodChoice.classList.remove('fadeOut');
    foodChoice.classList.add('animated', 'fadeIn');
    foodAllergy.style.display = 'flex';
    foodAllergy.classList.remove('fadeOut');
    foodAllergy.classList.add('animated', 'fadeIn');
  }
  // hide
  else if(foodChoice.style.display === 'flex' && foodAllergy.style.display === 'flex'){
    foodChoice.classList.remove('fadeIn');
    foodChoice.classList.add('animated', 'fadeOut');
    foodChoice.style.display = 'none';
    foodAllergy.classList.remove('fadeIn');
    foodAllergy.classList.add('animated', 'fadeOut');
    foodAllergy.style.display = 'none';
    resetCheckbox(checkbox);
    allergyTextarea.value = '';
  }
}
function showPlusOne(){
  let foodChoice = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoicePlusOne_Holder');
  let foodAllergy = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergiesPlusOne_Holder');
  let plusOne = document.getElementById('PlusOneInfo');
  let nameInput = document.getElementById('RecaptchaForm_EventRegistrationForm_PlusOneName');
  let dayCheckbox = document.getElementById('RecaptchaForm_EventRegistrationForm_AttendancePlusOne');
  let foodCheckbox = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodChoicePlusOne');
  let allergyTextarea = document.getElementById('RecaptchaForm_EventRegistrationForm_FoodAllergiesPlusOne');
  if(plusOne.style.display === 'none'){
    plusOne.style.display = 'flex';
    plusOne.classList.remove('fadeOut');
    plusOne.classList.add('animated', 'fadeIn');
  }
  else if(plusOne.style.display === 'flex'){
    plusOne.classList.remove('fadeIn');
    plusOne.classList.add('animated', 'fadeOut');
    plusOne.style.display = 'none';
    foodChoice.classList.remove('fadeIn');
    foodChoice.classList.add('animated', 'fadeOut');
    foodChoice.style.display = 'none';
    foodAllergy.classList.remove('fadeIn');
    foodAllergy.classList.add('animated', 'fadeOut');
    foodAllergy.style.display = 'none';
    resetCheckbox(dayCheckbox);
    resetCheckbox(foodCheckbox);
    allergyTextarea.value = '';
    nameInput.value = '';
  }
}

function resetCheckbox(el){
  let children = el.children;
  for (const key in children) {
    if(children[key].children){
      children[key].children[0].checked = false;
    }
  }
}