<template>
    <Head title="About" />
    <DefaultLayout :canLogin="canLogin" :can-register="canRegister" :user_id="user_id">
        <div class="max-w-5xl mx-auto">
            <h3 class="text-3xl text-center font-bold underline mb-6">About Our Company</h3>
            <div>
                <h4 class="font-semibold text-2xl">Our Mission</h4>
                <p>"FlavorWave's mission is to create a world where every bite and sip is an adventure in taste. We are dedicated to crafting exceptional food and beverage experiences that excite the senses and redefine culinary expectations. Our commitment to quality, authenticity, and customer satisfaction is unwavering. Join us in the pursuit of gastronomic excellence, where every FlavorWave product is a testament to our passion for delicious moments."</p>
            </div>
            <div class="mt-10">
                <h4 class="font-semibold text-2xl">Our Goal</h4>
                <p>"Elevate Taste Sensations: Craft unique flavor profiles that tantalize taste buds, making each FlavorWave experience a culinary journey of delight.Sustainable Sips: Develop a line of eco-friendly beverages, using locally sourced ingredients and innovative packaging to minimize environmental impact.Culinary Fusion: Blend diverse culinary traditions to create mouthwatering combinations, offering customers a fusion of global flavors in every bite."</p>
            </div>
            <div class="flex items-center justify-center mt-5">
                <p>2,300k reviews by our customers.</p>
                <i class="fa-solid fa-star icon"></i>
                <i class="fa-solid fa-star icon"></i>
                <i class="fa-solid fa-star icon"></i>
                <i class="fa-solid fa-star icon"></i>
                <i class="fa-solid fa-star icon"></i>
            </div>
            <div class="text-sm flex mt-10 gap-8">
                <div class="review"> 
                    <img src="/photo/review1.jpg" width="100" alt="reviewimg" class="rounded">
                    <p>"Flavorwave Company's food and beverage offerings are a gustatory delight! From the tantalizing aroma to the burst of flavors, each bite is a journey of culinary excellence. The innovative combinations and premium ingredients set them apart. A must-try for food enthusiasts!"</p>
                </div>
                <div class="review"> 
                    <img src="/photo/review2.jpg" width="100" alt="reviewimg" class="rounded">
                    <p>"Flavorwave Company's food is a revelation! The fusion of unique flavors creates an unforgettable dining experience. The beverage selection is equally impressive, offering refreshing choices that complement the diverse menu. A perfect destination for those seeking a culinary adventure."</p>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    user_id:{
        type:Number
    }
});
</script>

<style scoped>
.icon{
    color: yellow;
}
.review{
    width: 550px;
    display: flex;
    gap: 10px;
}
</style>
