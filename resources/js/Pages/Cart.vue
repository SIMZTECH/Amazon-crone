<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import {computed, ref} from 'vue';

    
   import {Iproduct, useCart } from '@/store/Cart';
   import { storeToRefs } from 'pinia';

   const cartStore = useCart();
   const {cartBasket} = storeToRefs(cartStore);

    // remove from cart method
    function removeFromCart(_id:number){
        cartStore.removeFromCart(_id); 
    }

    // calculate total products
    const total = computed<number>(():number=>{
        const totalAmount=ref(0);
        cartBasket.value.map((product:Iproduct)=>{
            totalAmount.value+=product.price;
        });
        return (Number(totalAmount.value)>0)?Number(totalAmount.value.toFixed(2)):0;
    });

    function totalWithoutDot():number{
        const num=total.value.toString().split('.').join();
        return Number(num);
    }

    //is product already in cart
    // const isProductAlreadyInCart=computed<boolean>(():boolean=>{
    //     const hasProduct=cartBasket.value.find((el:Iproduct)=>el?.id==product.value.id);
    //     return (hasProduct)?true:false;
    // });

</script>

<template>
    <Head title="Cart" />
    <AuthenticatedLayout>
        <div class="flex gap-4">
            <div class="w-full p-4 mt-4 bg-white">
                <div class="border-b">
                    <div class="text-[27px] font-semibold">Shopping Cart</div>
                    <div class="flex items-center justify-end w-full text-sm font-semibold">Price</div>
                </div>
                <div v-if="!cartBasket.length" class="py-20 text-2xl font-bold text-center">
                    Your Amazon Cart is empty!
                </div>

                <div v-else class="flex border-b" v-for="product in cartBasket" :key="product.id">
                    <img class="h-[180px] mt-4 mb-4" :src="product.image" />
                    <div class="flex justify-between mb-4">
                        <div class="relative py-4 pl-8">
                            <div class="text-gray-900 pb-2 -mt-4 font-bold text-[18px]">{{ product.title }}</div>
                            <span>{{ product.description.substring(0,180) }}...</span>
                            <div class="py-2 text-teal-600">In Stock</div>
                            <div class="absolute bottom-0 flex items-center mb-4 text-teal-600"></div>
                            <div v-on:click="removeFromCart(product.id)" class="text-sm cursor-pointer hover:underline">
                                Delete
                            </div>
                        </div>
                        <div class="justify-end py-10">
                            <div class="pl-20 font-bold">{{ product.price }}</div>
                        </div>
                    </div>
                </div>
                <div class=" font-extrabold text-[18px] pt-4 text-right">SubTotal {Items:{{cartBasket.length }}}:${{ total }}</div>
            </div>
            <div class="bg-white w-[350px] p-4 mt-4 h-48">
                <div class="text-sm text-green-700">
                    Welcome to Amazon! FREE Delivery on your first order to UK or Ireland.
                    Select this option at checkout
                </div>
                <div class=" font-extrabold text-[18px] pt-4">SubTotal {Items:{{cartBasket.length }}}:${{ total }}</div>
                <Link
             class="block w-full py-1 mt-4 text-sm font-bold text-center border rounded-lg shadow-sm cursor-pointer"
             :disabled="Number(total)===0.00"
             :class="Number(total)===0.00?'bg-gray-400':'bg-yellow-400 hover:bg-yellow-500'"
             as="button"
             method="post"
             :href="$page.props.auth.user?route('checkout.store',
                {
                    total:totalWithoutDot(),
                    total_decimal:total,
                    items:cartBasket
                }):route('login')"
            >
             Proceed to Checkout
            </Link>
            </div>
            
        </div>

       
       
    </AuthenticatedLayout>
</template>

