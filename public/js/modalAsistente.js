const modal =  document.querySelector('.modal');

const showModal =  document.querySelector('.show-modal');
const closeModal =  document.querySelector('.close-modal');

const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const confirmBtn = document.getElementById('confirm-btn');



const steps = ['step-1', 'step-2', 'step-3','step-4'];
let currentStep = 0;

function showStep(stepIndex) {
    steps.forEach(step => {
        const element = document.getElementById(step + '-content');
        if (element) {
            if (step === steps[stepIndex]) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    });
}

function updateButtons() {
    prevBtn.disabled = currentStep === 0;
    nextBtn.disabled = currentStep === steps.length - 1;
    confirmBtn.classList.toggle('hidden', currentStep !== steps.length - 1);
}

function updateStepIndicator() {
    const stepIndicators = document.querySelectorAll('.flex li');
    stepIndicators.forEach((indicator, index) => {
        indicator.classList.remove('text-blue-600', 'dark:text-blue-500', 'text-yellow-500', 'dark:text-yellow-400');
        if (index === currentStep) {
            indicator.classList.add('text-yellow-500', 'dark:text-yellow-400');
        } else if (index < currentStep) {
            indicator.classList.add('text-blue-600', 'dark:text-blue-500');
        }
    });
}

function updateModalContent() {
    const content = document.querySelector(`#${steps[currentStep]}-content p`);
    if (content) {
        switch (currentStep) {
            case 0:
                content.textContent = 'Content for step 1.';
                break;
            case 1:
                content.textContent = 'Content for step 2.';
                break;
            case 2:
                content.textContent = 'Content for step 3.';
                break;
            case 3:
                content.textContent = 'Content for step 4.';
            break;
        }
    }
}

function initModal() {
    showStep(currentStep);
    updateButtons();
    updateStepIndicator();
    updateModalContent();
}

prevBtn.addEventListener('click', () => {
    if (currentStep > 0) {
        currentStep--;
        initModal();
    }
});

nextBtn.addEventListener('click', () => {
    if (currentStep < steps.length - 1) {
        currentStep++;
        initModal();
    }
});

document.addEventListener('DOMContentLoaded', initModal);

showModal.addEventListener('click', function(){
    modal.classList.remove('hidden');
    currentStep = 0;
    initModal();
});

closeModal.addEventListener('click', function(){
    modal.classList.add('hidden');
});
