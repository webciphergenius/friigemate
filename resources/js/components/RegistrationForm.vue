<template>
  <div class="mainRegister p-5 text-white">
    <div class="panelLogo">
      <img src="../../images/logo.png" alt="brand-logo" />
    </div>
    <div class="tab-buttons flex justify-center mb-5 space-x-4">
      <button
        :class="{
          'bg-blue-500 text-white': activeTab === 'shipper',
          'bg-gray-300 text-black': activeTab !== 'shipper',
        }"
        class="px-4 py-2 rounded"
        @click="activeTab = 'shipper'"
      >
        Shipper
      </button>
      <button
        :class="{
          'bg-blue-500 text-white': activeTab === 'driver',
          'bg-gray-300 text-black': activeTab !== 'driver',
        }"
        class="px-4 py-2 rounded"
        @click="activeTab = 'driver'"
      >
        Driver
      </button>
    </div>

    <div v-if="activeTab === 'shipper'">
      <registration-shipper></registration-shipper>
    </div>

    <div v-if="activeTab === 'driver'">
      <registration-driver></registration-driver>
    </div>
  </div>
</template>

<script>
import RegistrationShipper from './RegistrationShipper.vue';
import RegistrationDriver from './RegistrationDriver.vue';

export default {
  components: {
    RegistrationShipper,
    RegistrationDriver,
  },
  data() {
    return {
      activeTab: 'shipper',
    };
  },
};
</script>

<style scoped>
.input-style {
  @apply mt-1 block w-full border-gray-300 rounded-md shadow-sm;
}
</style>