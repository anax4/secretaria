document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('alunoForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const cpfInput = form.cpf;

    submitBtn.disabled = true;

    cpfInput.addEventListener("input", function () {
        let value = cpfInput.value.replace(/\D/g, "");
        if (value.length > 11) value = value.slice(0, 11);

        if (value.length > 9) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, "$1.$2.$3-$4");
        } else if (value.length > 6) {
            value = value.replace(/(\d{3})(\d{3})(\d{0,3})/, "$1.$2.$3");
        } else if (value.length > 3) {
            value = value.replace(/(\d{3})(\d{0,3})/, "$1.$2");
        }

        cpfInput.value = value;
    });


    cpfInput.addEventListener("keypress", function (event) {
        if (!/[0-9]/.test(event.key)) {
            event.preventDefault();
        }
    });


    async function verificarDuplicidade(cpf, email) {
        try {
            const response = await fetch(`/aluno/verificar?cpf=${cpf}&email=${email}`);
            const data = await response.json();

            if (data.cpfExiste) {
                cpfInput.classList.add('is-invalid');
                cpfInput.classList.remove('is-valid');
                return false;
            }

            if (data.emailExiste) {
                form.email.classList.add('is-invalid');
                form.email.classList.remove('is-valid');
                return false;
            }

            return true;
        } catch (error) {
            console.error("Erro ao verificar duplicidade:", error);
            return true;
        }
    }

    async function validateForm() {
        let isValid = true;

        // Nome
        let nome = form.nome.value.trim();
        if (nome.length < 3) {
            form.nome.classList.add('is-invalid');
            form.nome.classList.remove('is-valid');
            isValid = false;
        } else {
            form.nome.classList.add('is-valid');
            form.nome.classList.remove('is-invalid');
        }

        // Data de nascimento
        let dataNasc = form.data_nascimento.value.trim();
        if (!/^\d{4}-\d{2}-\d{2}$/.test(dataNasc)) {
            form.data_nascimento.classList.add('is-invalid');
            form.data_nascimento.classList.remove('is-valid');
            isValid = false;
        } else {
            form.data_nascimento.classList.add('is-valid');
            form.data_nascimento.classList.remove('is-invalid');
        }

        // CPF
        let cpf = form.cpf.value.trim();
        let cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
        if (!cpfRegex.test(cpf)) {
            form.cpf.classList.add('is-invalid');
            form.cpf.classList.remove('is-valid');
            isValid = false;
        } else {
            form.cpf.classList.add('is-valid');
            form.cpf.classList.remove('is-invalid');
        }

        // Email
        let email = form.email.value.trim();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            form.email.classList.add('is-invalid');
            form.email.classList.remove('is-valid');
            isValid = false;
        } else {
            form.email.classList.add('is-valid');
            form.email.classList.remove('is-invalid');
        }

        // Senha
        let senha = form.senha.value;
        let senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!senhaRegex.test(senha)) {
            form.senha.classList.add('is-invalid');
            form.senha.classList.remove('is-valid');
            isValid = false;
        } else {
            form.senha.classList.add('is-valid');
            form.senha.classList.remove('is-invalid');
        }

        if (cpfRegex.test(cpf) && emailRegex.test(email) && isValid) {
            const duplicado = await verificarDuplicidade(cpf, email);
            if (!duplicado) isValid = false;
        }

        submitBtn.disabled = !isValid;
    }


    form.addEventListener('input', validateForm);


    form.nome.addEventListener("blur", validateForm);
    form.data_nascimento.addEventListener("blur", validateForm);
    cpfInput.addEventListener("blur", validateForm);
    form.email.addEventListener("blur", validateForm);
    form.senha.addEventListener("blur", validateForm);


    form.addEventListener('submit', async function (event) {
        await validateForm();
        if (submitBtn.disabled) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            form.cpf.value = form.cpf.value.replace(/\D/g, "");
        }
    });
});
