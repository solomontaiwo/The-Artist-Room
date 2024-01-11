<template>
    <h1 class="funky-title">Prossime mostre</h1>
    <hr />
    <div class="row">
        <div class="col-md-6" v-for="(mostra, index) in mostre" :key="index">
            <div class="card">
                <img :src="mostra.immagine" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title">{{ mostra.nome }}</h5>
                    <p class="card-text" v-show="mostra.mostraDettagli">
                        {{ mostra.descrizione }}
                    </p>
                    <button
                        class="btn btn-outline-success btn-sm"
                        @click="toggleDettagli(index)"
                    >
                        Mostra dettagli
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mostre: [
                {
                    nome: "Achille Funi. Un maestro del Novecento tra storia e mito",
                    descrizione:
                        "Virgilio Socrate Achille Funi (Ferrara, 1890 – Appiano Gentile, 1972) ha attraversato da protagonista i principali movimenti che hanno caratterizzato la cultura italiana della prima metà del Novecento. Dopo essersi distinto nell’ala moderata del Futurismo, si è affermato come uno tra i grandi interpreti del Realismo magico, del moderno classicismo di “Novecento” e del muralismo degli anni Trenta, pur mantenendo sempre una spiccata autonomia.",
                    immagine: "/images/achille.jpg",
                    mostraDettagli: false,
                },
                {
                    nome: "Ritorno a Ferrara. L'universo di Leo Contini Lampronti",
                    descrizione:
                        "Dal 9 novembre, il Museo Nazionale dell’Ebraismo Italiano e della Shoah - MEIS ospita la mostra Ritorno a Ferrara. L’universo di Leo Contini Lampronti, curata da Hava Contini e Yael Sonnino-Levy. Un percorso che vuole riscoprire un artista curioso ed eclettico, alla costante ricerca di un dialogo intimo tra sperimentazione artistica e ispirazione religiosa.",
                    immagine: "/images/ebraismo.jpg",
                    mostraDettagli: false,
                },
            ],
        };
    },
    methods: {
        toggleDettagli(index) {
            this.mostre[index].mostraDettagli =
                !this.mostre[index].mostraDettagli;
        },
    },
};
</script>

<style>
.funky-title {
    transform: rotate(-10deg);
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateY(0);
    }

    40% {
        transform: translateY(-30px);
    }

    60% {
        transform: translateY(-15px);
    }
}
</style>
