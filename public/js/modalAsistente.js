const modal =  document.querySelector('.modal');

const showModal =  document.querySelector('.show-modal');
const closeModal =  document.querySelector('.close-modal');

const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const confirmBtn = document.getElementById('confirm-btn');

const overlay = document.getElementById("modalOverlay");


const steps = ['step-1', 'step-2', 'step-3'];
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
                content.innerHTML = `<p>Seguro que quiere migrar, esa base de datos, dale click en <strong>confirma</strong>, para hacer la migración.</p>`;
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
    overlay.style.display = "block";
    currentStep = 0;
    initModal();
});

closeModal.addEventListener('click', function(){
    modal.classList.add('hidden');
    overlay.style.display = "none";
});


const manejadorBDSelect = document.getElementById('manejadorBD');
const sqlServerDiv = document.getElementById('escogerBDSqlServer');
const mySqlDiv = document.getElementById('escogerBDMySql');


manejadorBDSelect.addEventListener('change', function() {
    const selectedOption = parseInt(manejadorBDSelect.value);
    if (selectedOption === 0) {
        sqlServerDiv.classList.remove('hidden');
        mySqlDiv.classList.add('hidden');
    } else if (selectedOption === 1) {
        mySqlDiv.classList.remove('hidden');
        sqlServerDiv.classList.add('hidden');
    } else {
        // En caso de una selección inválida
        sqlServerDiv.classList.add('hidden');
        mySqlDiv.classList.add('hidden');
    }
});