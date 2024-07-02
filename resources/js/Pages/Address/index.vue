import { Head } from '@inertiajs/vue3';
<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import { toRefs, defineProps, ref, computed } from 'vue';
    import Plus from 'vue-material-design-icons/Plus.vue';
    
    const props = defineProps({product:Object});
    const {product}=toRefs<any>(props);

    const show = ref(computed(()=>{
        const isAddressExist=usePage().props.auth.address as any;
        return (isAddressExist)?true:false;
    }));




</script>

<template>
    <Head title="Address" />
    <AuthenticatedLayout>
        <div class="mt-12">
            
        </div>
        <div class="max-w-[100px] mx-auto text-3xl mb-10">
            Your Addresses
        </div>

        <div class="max-w-[1000px] mx-auto flex gap-2 h-[270px]">
            <div class="w-1/3 border border-gray-400 border-dotted rounded-md">
                <Link v-if="!show" :href="route('address_options.index')">
                    <div class="grid h-full cursor-pointer place-items-center">
                        <div class="text-center">
                            <div class="flex justify-center">
                                <Plus :size="50"/>
                            </div>
                            <div class="text-2xl font-bold">Add Address</div>
                        </div>
                    </div>
                </Link>

                <!-- else address added -->
                 <div v-else class="grid h-full place-items-center">
                    <div class="text-center">
                        <div class="text-2xl font-bold">Address is added</div>
                    </div>
                 </div>
            </div>

            <div v-if="show" class="relative w-1/3 border border-gray-400 rounded-md shadow-md">
                <div class="flex items-center justify-start p-3 text-xs font-extrabold text-gray-600 border-b border-b-gray-400">
                    Default:
                    <img class="h-3 mt-1.5 ml-2" src="/public/images/am_logo/AMAZON_LOGO_DARK.png" alt=""/>
                </div>
                <div class="px-4 pt-4 text-sm font-extrabold">
                    {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
                </div>
                <div class="px-4 text-sm">
                    <div>{{ $page.props.auth.address?.add1 }}</div>
                    <div>{{ $page.props.auth.address?.add2}}</div>
                    <div>{{ $page.props.auth.address?.city }}</div>
                    <div>{{ $page.props.auth.address?.postcode }}</div>
                    <div>{{ $page.props.auth.address?.country }}</div>
                </div>
                <div class="absolute bottom-0 px-4 pb-4">
                    <Link 
                        method="delete" 
                        as="button"
                      :href="route('address_options.destroy',{id:$page.props.auth.address?.id||0})" class="text-sm font-extrabold text-teal-700 hover:underline hover:text-red-700">
                        Remove
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
