<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import {toRefs,defineProps, computed} from 'vue';
import MapMarkerOutline from 'vue-material-design-icons/MapMarkerOutline.vue';
    
   import { Iproduct, useCart } from '@/store/Cart';
   import { storeToRefs } from 'pinia';

   const cartStore = useCart();
   const {cartBasket} = storeToRefs(cartStore);

   const {removeFromCart}=cartStore;
    
    const props = defineProps({product:Object});
    const {product}=toRefs<any>(props);

    // add to cart method
    function addToCart(_product:Iproduct){
        cartBasket.value.push(_product);
    }

    //is product already in cart
    const isProductAlreadyInCart=computed<boolean>(():boolean=>{
        const hasProduct=cartBasket.value.find((el:Iproduct)=>el?.id==product.value.id);
        return (hasProduct)?true:false;
    });

</script>

<template>
    <Head title="Product" />
    <AuthenticatedLayout>
        <div class="mt-16"></div>
        <div class="max-w-[1200px] mx-auto flex gap-4 justify-between">
            <div class="w-2/5">
                <img :src="product.image"/>
            </div>
            <div class="w-2/5">
                <div class="m-1 text-lg font-extrabold">About this item</div>
                <div>{{product.description }}</div>
            </div>
            <div class="w-1/5">
                <div class="border border-gray-300 rounded-lg">
                    <div class="mx-3 my-2 mb-2">
                        <div class="flex items-center justify-center pb-1 border-b border-gray-300">
                            <Link
                                v-if="$page.props.auth.user"  
                                :href="route('address.index')"
                                class="flex items-center text-xs font-extrabold text-teal-700 cursor-pointer hover:text-red-600"
                                >
                                <MapMarkerOutline :size="17" />
                                Deliver to {{ $page.props.auth?.user?.first_name }} - {{ $page.props.auth?.address?.postcode }}
                            </Link>
                            <Link
                                v-if="!$page.props.auth.user" 
                                :href="route('login')"
                                class="flex items-center text-xs font-extrabold text-teal-700 cursor-pointer hover:text-red-600"
                                >
                                Sign in
                            </Link>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <div class="text-sm font-bold text-red-600">PRICE {{product.price}}</div>
                            <button 
                                v-on:click="addToCart(product)"
                                :disabled="isProductAlreadyInCart" class="px-2 text-sm font-bold bg-yellow-400 border rounded-lg shadow-sm cursor-pointer">
                                <span v-if="isProductAlreadyInCart">item added</span>
                                <span v-else>Add to cart</span>
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

