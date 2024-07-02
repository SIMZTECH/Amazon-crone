<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

    import 'vue3-carousel/dist/carousel.css';

   
</script>

<template>

    <!-- {{ $page.props.auth.user }} -->

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <carousel :items-to-show="1.5">
            <slide v-for="slide in 6" :key="slide">
                <div class="carousel_item">
                    <img :src="`/images/carousel/slide${slide}.jpg`" alt="" />
                </div>
            </slide>
            <template #addons>
                <navigation />
                <pagination />
            </template>
        </carousel>
        <div class="relative -mt-[300px]">
            <div class="relative z-10 flex m-4">
                <div class="w-full p-2 mx-2 text-center bg-white text-md">
                    You are on amazon.com You can also shop on Amazon UK for millions of products with fast local
                    delivery.
                    <span class="text-teal-600 underline cursor-pointer">Click here to go to amazon.co.uk</span>
                </div>
            </div>
            <div class="relative z-10 grid grid-cols-3 m-4">
               <div class="p-1.5 flex" v-for="category in $page.props.categories" :key="category">
                    <Link :href="route('category.index',{id:category?.id})" class="p-5 bg-white" >
                        <div class="flex text-2xl font-extrabold">{{ category.name }}</div>
                        <div class="flex">
                            <img class="object-fill " :src="`/images/categories/${category.id}.png`" alt="" />
                        </div>
                        <div class="pt-3 -mb-2 font-bold text-teal-800 cursor-pointer hover:underline hover:text-red-400">
                            See More
                        </div>
                    </Link>
               </div> 
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.carousel_item{
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.carousel_prev,
.carousel_next{
    width:40px;
    height:200px;
    color:rgb(196,196,196);
    margin-top:-100px;
    border:transparent;
}

.carousel_prev:hover,
.carousel_next:hover{
    width:40px;
    height:200px;
    color:rgb(212,212,212);
    margin-top:-100px;
    border:3px solid rgb(217,217,217);
}

</style>
