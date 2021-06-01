<template>
  <breeze-authenticated-layout>
    <template #header>
      <breeze-heading>Edit User - {{ form.name }}</breeze-heading>
    </template>

    <div v-show="form.hasErrors">
      <div class="text-red-600 font-medium">
        Please make the following corrections:
      </div>
    </div>

    <div v-show="form.wasSuccessful">
      <div class="text-green-600 font-medium">Profile Updated.</div>
    </div>
    <div v-show="form.recentlySuccessful">
      <div class="text-green-600 font-medium">Profile was updated.</div>
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

      <div>
        <breeze-label for="image" value="Image"></breeze-label>
        <input
          type="file"
          class="hidden"
          ref="photo"
          @change="updatePhotoPreview"
        />

        <div class="mt-2" v-show="!photoPreview && user.image">
          <img
            :src="currentImage()"
            class="rounded-full h-20 w-20 object-cover"
          />
        </div>

        <div class="mt-2" v-show="photoPreview">
          <span
            class="block rounded-full w-20 h-20"
            :style="
              'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
              photoPreview +
              '\');'
            "
          >
          </span>
        </div>

        <breeze-input-error :message="form.errors.image"></breeze-input-error>

        <breeze-button
          class="mt-2 mr-2"
          type="button"
          @click.prevent="selectNewPhoto"
          >Select a New Photo</breeze-button
        >
      </div>

      <!-- submit -->
      <div class="flex items-center justify-end mt-4">
        <breeze-reset-button @click="resetForm">Reset</breeze-reset-button>
        <breeze-button :loading="form.processing">Update</breeze-button>
      </div>
    </form>
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
import BreezeHeading from "@/Components/Heading";
import BreezeSelect from "@/Components/Select";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeLink,
    BreezeLabel,
    BreezeInput,
    BreezeButton,
    BreezeResetButton,
    BreezeInputError,
    BreezeHeading,
    BreezeSelect,
  },
  setup(props) {
    const form = useForm({
      _method: "PUT",
      name: props.user.name,
      email: props.user.email,
      image: props.user.image,
    });

    return { form };
  },
  props: {
    user: Object,
  },
  data() {
    return {
      photoPreview: null,
    };
  },
  methods: {
    submit() {
      if (this.$refs.photo) {
        this.form.image = this.$refs.photo.files[0];
      }
      this.form.post(route("update-profile"), {
        preserveScroll: (page) => Object.keys(page.props.errors).length,
      });
    },
    resetForm() {
      this.form.clearErrors();
      this.form.reset();
    },
    currentImage() {
      return "/storage/" + this.user.image;
    },
    selectNewPhoto() {
      this.$refs.photo.click();
    },
    updatePhotoPreview() {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };
      reader.readAsDataURL(this.$refs.photo.files[0]);
    },
  },
};
</script>
