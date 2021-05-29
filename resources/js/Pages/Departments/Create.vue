<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create New Department
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
             
            <div v-show="form.hasErrors">
                <div class="text-red-600 font-medium">Please make the following corrections:</div>
            </div>
            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="name" value="Name"></breeze-label>
                    <breeze-input
                        type="text"
                        id="name"
                        class="mt-1 block w-1/2"
                        v-model="form.name"
                        required
                        autofocus
                        :error="form.errors.name"
                    ></breeze-input>
                    <breeze-input-error :message="form.errors.name"></breeze-input-error>
                </div>
                <div class="mt-4">
                    <breeze-label for="email" value="Email"></breeze-label>
                    <breeze-input
                        type="email"
                        id="email"
                        class="mt-1 block w-1/2"
                        v-model="form.email"
                        :error="form.errors.email"
                    ></breeze-input>
                    <breeze-input-error :message="form.errors.email"></breeze-input-error>
                </div>
                <div class="mt-4">
                    <breeze-label for="phone" value="Phone"></breeze-label>
                    <breeze-input
                        type="text"
                        id="phone"
                        class="mt-1 block w-1/2"
                        v-model="form.phone"
                        :error="form.errors.phone"
                    ></breeze-input>
                    <breeze-input-error :message="form.errors.phone"></breeze-input-error>
                </div>

                <!-- submit -->
                <div class="flex items-center justify-end mt-4">
                    <breeze-reset-button
                        @click="resetForm"
                    >Reset</breeze-reset-button>
                    <breeze-button
                        :loading="form.processing"
                    >Create</breeze-button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeLink from "@/Components/AnchorLink";
import BreezeLabel from "@/Components/Label";
import BreezeInput from "@/Components/Input";
import BreezeInputError from "@/Components/InputError";
import BreezeButton from "@/Components/Button";
import BreezeResetButton from "@/Components/ResetButton";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeLink,
    BreezeLabel,
    BreezeInput,
    BreezeButton,
    BreezeResetButton,
    BreezeInputError,
  },
  setup () {
    const form = useForm({
      name: null,
      email: null,
      phone: null,
    })

    return { form }
  },
  methods : {
      submit() {
          this.form.post(route('departments.store'));
      },
      resetForm() {
          this.form.clearErrors();
          this.form.reset();
      }
  }
};
</script>
