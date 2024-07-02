import { Head } from '@inertiajs/vue3';
<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link,useForm,usePage} from '@inertiajs/vue3';
    import { toRefs, defineProps, ref} from 'vue';
    import Plus from 'vue-material-design-icons/Plus.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';

    const form = useForm({
        country:'United Kingdom',
        first_name:usePage<any>().props.value?.auth.user.first_name,
        last_name:usePage<any>().props.value?.auth.user.last_name,
        addr1:'',
        addr2:'',
        city:'',
        postcode:''
    });

    const onSubmitHandler=():void=>{
        form.post(route('address_options.store'),{
            onFinish:()=>route('address.index')
        });
    };


</script>

<template>
    <Head title="Add-address" />
    <AuthenticatedLayout>
        <div class="mt-8">
            
        </div>
        <div class="w-[500px] mx-auto text-2xl font-extrabold">
            <div>Add a new address</div>
            <form v-on:submit.prevent="onSubmitHandler">
                <div class="text-[15px] -mb-1.5 font-extrabold">Country</div>
                <select
                     v-model="form.country"
                     class="w-full py-1 bg-gray-200 border-gray-300 rounded-lg shadow-md cursor-pointer focus:border-orange-400 focus:ring-orange-400 hover:bg-gray-300"
                    >
                    <option selected value="United Kingdom">United Kingdom</option>
                    <option value="Germany">Germany</option>
                    <option value="France">France</option>
                </select>
                <div class="mt-4">
                    <InputLabel class="-mb-1.5" value="First name"/>
                    <TextInput v-model="form.last_name" type="text" class="block w-full mt-1" required />
                </div>
                <div class="mt-3">
                    <InputLabel class="-mb-1.5" value="Last name"/>
                    <TextInput v-model="form.first_name" type="text" class="block w-full mt-1" required />
                </div>
                <div class="mt-3">
                    <InputLabel class="-mb-1.5" value="Address"/>
                    <TextInput v-model="form.addr1" type="text" placeholder="Address 1" class="block w-full mt-1"/>
                    <TextInput v-model="form.addr2" type="text" placeholder="Address 2" class="block w-full mt-1"/>
                </div>

                <div class="mt-3">
                    <div class="flex gap-2">
                        <div class="w-full">
                            <InputLabel class="-mb-1.5" value="City"/>
                            <TextInput v-model="form.city" type="text" placeholder="city" class="block w-full mt-1"/>
                        </div>
                        <div class="w-full">
                            <InputLabel class="-mb-1.5" value="postcode"/>
                            <TextInput v-model="form.postcode" type="text" placeholder="postcode" class="block w-full mt-1"/>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button class="bg-yellow-400 px-3 font-bold text-[14px] rounded-lg shadow-sm cursor-pointer">Add Address</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
