<script setup lang="ts">
   import { Head,Link} from '@inertiajs/vue3';
    import {onMounted} from 'vue';
    import CheckIcon from 'vue-material-design-icons/Check.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

   import {useCart } from '@/store/Cart';
   import { storeToRefs } from 'pinia';

   const cartStore = useCart();
   const {cartBasket} = storeToRefs(cartStore);

    onMounted(()=>{ 
        cartBasket.value=[];  
    });

</script>

<template>
    <Head title="Checkout Success" />
    <AuthenticatedLayout>
        <div class="max-w-xl mx-auto mb-6 text-3xl font-extrabold mt-18">Checkout Success</div> 
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-sm">
                <div class="flex flex-col items-center text-center">
                    <div class="inline-block p-4 bg-green-100 rounded-full ">
                        <CheckIcon :size="100" fillColor="#7CFC00"/>
                    </div>
                    <h2 class="mt-2 text-2xl font-semibold text-gray-800">
                        Success
                    </h2>
                    <p class="mt-2 text-lg font-bold leading-relaxed text-gray-600">
                        Your order is on its way!!
                    </p>
                </div>
                <Link
                    href="/" class="flex items-center mt-3">
                    <button class="flex-1 px-4 py-2 ml-2 font-bold text-gray-900 bg-yellow-500 rounded-md hover:bg-yellow-500">
                        Home
                    </button>
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

