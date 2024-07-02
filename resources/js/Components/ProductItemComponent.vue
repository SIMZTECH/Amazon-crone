<script setup lang="ts">
import {Link } from '@inertiajs/vue3';
import {toRefs,defineProps} from 'vue';
    
    const props = defineProps({product:Object});
    const {product}=toRefs<any>(props);
</script>

<template>
    <div class="border border-gray-300 rounded-md bg-white p-1.5">
        <Link :href="route('product.index',{id:product.id})" class="w-full">
            <img class="rounded-md" :src="product.image" />
            <div class="text-left">
                <div class="text-[16px] text-gray-900 font-extrabold cursor-pointer">
                    {{product.title}} 
                </div>
                <div class="flex items-center justify-between">
                    <div class="w-full p-1 text-2xl font-semibold text-left">{{product.price}}</div>
                    <img width="80" src="/images/am_logo/PRIME_LOGO.png" />
                </div>
                <div class="flex items-center justify-between">
                    <div class="w-full p-1 font-semibold text-left text-md">In Stock</div>
                </div>
                <div class="flex items-center justify-between">
                    <img width="80" src="/images/STARS.png" />
                </div>
            </div>
        </Link>
    </div>
</template>


