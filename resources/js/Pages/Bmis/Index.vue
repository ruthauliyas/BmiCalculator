<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props  = defineProps({
    bmis: Array 
});
</script>

<template>
    <Head title="BMI" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">BMI Calculator</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto my-10">
                            <div class="flex justify-between items-center">
                                <h1 class="text-center text-4xl font-bold mb-6">BMI Calculator</h1>
                            </div>

                            <form class="flex flex-col items-left" @submit.prevent="storeBmi">
                                <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="weight">
                                    Weight (kg)
                                </label>
                                <input
                                    v-model.number="form.weight"
                                    type="number"
                                    id="weight"
                                    name="weight"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Enter your weight in kilograms"
                                    required
                                />
                                </div>

                                <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="height">
                                    Height (cm)
                                </label>
                                <input
                                    v-model.number="form.height"
                                    type="number"
                                    id="height"
                                    name="height"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Enter your height in centimeters"
                                    required
                                />
                                </div>

                                <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                >
                                Calculate
                                </button>
                            </form>

                            <div class="mt-8 text-center" v-if="bmi !== null">
                                <p class="font-bold text-2xl">Your BMI: {{ bmi }}</p>
                                <p class="font-bold text-2xl">Category: {{ bmiCategory }}</p>
                            </div>
                        </div>

                        <!-- Tampilkan komponen BmiHistory -->
                        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-4 bg-gray-100 border-b">
                                <h2 class="text-lg font-bold text-gray-800">BMI Histories</h2>
                            </div>
                            <div class="p-4">
                                <table class="w-full">
                                <thead>
                                    <tr>
                                    <th class="py-2">No.</th>
                                    <th class="py-2">Height (cm)</th>
                                    <th class="py-2">Weight (kg)</th>
                                    <th class="py-2">BMIScore</th>
                                    <th class="py-2">Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(bmi, i) in bmis" :key="bmi.id">
                                    <td class="py-2">{{ i + 1 }}</td>
                                    <td class="py-2">{{ bmi.height }}</td>
                                    <td class="py-2">{{ bmi.weight }}</td>
                                    <td class="py-2">{{ bmi.bmiscore }}</td>
                                    <td class="py-2">
                                        <span v-if="bmi.bmiscore < 18.5">Underweight</span>
                                        <span v-else-if="bmi.bmiscore >= 18.5 && bmi.bmiscore < 24.9">Normal</span>
                                        <span v-else-if="bmi.bmiscore >= 24.9 && bmi.bmiscore < 30">Overweight</span>
                                        <span v-else>Obese</span>
                                    </td>
                                    <!-- <td>
                                      <Link
                                      :href="'/bmis/${bmi.id}'"
                                      method="delete" as="button" type="button"
                                      class="text-red-600 hover:text-red-900"
                                      >Delete</Link>
                                    </td> -->
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  weight: null,
  height: null,
})

function storeBmi() {
  form.post('/bmis')
}

export default {
  components: {
    AuthenticatedLayout,
    Head,
  },

  data() {
    return {
      weight: null,
      height: null,
      bmi: null,
    };
  },

  methods: {
    calculateBMI() {
      if (this.weight && this.height) {
        const heightInMeters = this.height / 100;
        this.bmi = (this.weight / (heightInMeters * heightInMeters)).toFixed(2);
      }
    },
  },

  computed: {
    bmiCategory() {
      if (this.bmi < 18.5) {
        return "Underweight";
      } else if (this.bmi >= 18.5 && this.bmi < 24.9) {
        return "Normal";
      } else if (this.bmi >= 24.9 && this.bmi < 30) {
        return "Overweight";
      } else {
        return "Obese";
      }
    },
  },
};
</script>