<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="hero-container">
                    <img class="background-image" src="@/assets/bgUtama2.jpg" alt="Background Image">
                    <v-app>
                        <div class="hero">
                        <h1>Welcome to e-BMI </h1>
                        <p>Indeks massa tubuh adalah metrik standar yang digunakan untuk menentukan siapa saja yang masuk dalam golongan berat badan sehat dan tidak sehat.</p>
                        <p>“Indeks massa tubuh adalah cara yang baik untuk menilai apakah berat badan Anda sehat atau tidak,” <br> <span>Jessica Crandall, RD.</span></p>
                        </div>
                    </v-app>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.hero-container {
  position: relative;
}

.background-image {
  width: 100%;
  height: auto;
}

.hero {
    display: inline-block !important;
    width: 40%;
    margin: 5%;
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    text-align: left;
    color: #ffffff;
}

p {
  font-size: 20px;
}
</style>


