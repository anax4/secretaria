document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("buscaAluno");
    const lista = document.getElementById("resultadoBusca");

    input.addEventListener("input", async function () {
        const nome = input.value.trim();
        lista.innerHTML = "";

        if (nome.length < 3) return;

        try {
            const response = await fetch(`/aluno/buscar?nome=${encodeURIComponent(nome)}`);
            const alunos = await response.json();

            if (alunos.length === 0) {
                const li = document.createElement("li");
                li.className = "list-group-item text-muted";
                li.innerText = "Nenhum aluno encontrado";
                lista.appendChild(li);
                return;
            }

            alunos.forEach(aluno => {
                const li = document.createElement("li");
                li.className = "list-group-item list-group-item-action";
                li.innerText = aluno.nome;
                li.style.cursor = "pointer";

                li.addEventListener("click", () => {
                    window.location.href = `/aluno/editar/${aluno.id}`;
                });

                lista.appendChild(li);
            });
        } catch (err) {
            console.error("Erro na busca:", err);
        }
    });
});
