<template>
  <div class="mt-6">

    <!-- HEADER -->
    <div class="d-flex align-center justify-space-between mb-4 px-2">
      <h4 class="text-subtitle-1 font-weight-bold text-primary">
        <v-icon start>mdi-layers-triple</v-icon>
        Additional Content Sections
      </h4>

      <v-btn color="primary" prepend-icon="mdi-plus" variant="tonal" @click="addSection">
        Add Section
      </v-btn>
    </div>

    <v-divider class="mb-6" />

    <!-- SECTIONS -->
    <v-card
      v-for="(section, index) in modelValue"
      :key="index"
      class="pa-4 mb-6 border-dashed"
      variant="outlined"
    >

      <!-- TOP BAR -->
      <div class="d-flex justify-space-between align-center mb-4">
        <v-chip color="grey" size="small" label>
          SECTION #{{ index + 1 }}
        </v-chip>

        <v-btn
          icon="mdi-delete-outline"
          color="error"
          variant="text"
          @click="removeSection(index)"
        />
      </div>

      <v-row>

        <!-- TITLE -->
        <v-col cols="12">
          <v-text-field
            v-model="section.distitle"
            label="Section Title"
            variant="outlined"
            density="compact"
          />
        </v-col>

        <!-- DESCRIPTION -->
        <v-col cols="12">
          <v-textarea
            v-model="section.disdescription"
            label="Section Description"
            variant="outlined"
            rows="5"
            auto-grow
            clearable
          />
        </v-col>

      </v-row>

    </v-card>

  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: Array,
      default: () => []
    }
  },

  emits: ['update:modelValue'],

  methods: {
    addSection() {
      const newList = [
        ...this.modelValue,
        {
          distitle: '',
          disdescription: ''
        }
      ];
      this.$emit('update:modelValue', newList);
    },

    removeSection(index) {
      const newList = [...this.modelValue];
      newList.splice(index, 1);
      this.$emit('update:modelValue', newList);
    }
  }
};
</script>

<style scoped>
.border-dashed {
  border: 1px dashed #ccc !important;
}
</style>