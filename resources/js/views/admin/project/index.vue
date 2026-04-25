<template>
  <div>
    

    <v-container max-width="1400" class="mx-auto pa-6 pa-md-10">
      <v-card color="surface" class="border" elevation="2">
        <div class="d-flex flex-column flex-md-row align-md-center justify-space-between pa-6 gap-4 border-b">
          <!-- Left Side: Entries & Info -->
          <div class="d-flex align-center flex-wrap gap-3">
            <v-select
              v-model="filter.length"
              :items="[10, 25, 50, 100]"
              label="Show"
              density="compact"
              variant="outlined"
              style="max-width: 100px"
              hide-details
            />

            <div class="text-body-2 text-light_text_on">
              {{ filter.offset + 1 }} - {{ Math.min(filter.offset + filter.length, total) }} of {{ total }} records
            </div>
          </div>


          <div class="d-flex align-center gap-3 flex-grow-1 justify-end">
            <v-text-field
              v-model="filter.search"
              label="Search projects..."
              variant="outlined"
              density="compact"
              hide-details
              clearable
              prepend-inner-icon="mdi-magnify"
              style="max-width: 320px"
              @keyup.enter="loadItems"
            />

            <v-btn
              color="primary"
              variant="flat"
              height="42"
              to="/admin/projects/create"
            >
              <v-icon start>mdi-plus</v-icon>
              New Project
            </v-btn>
          </div>
        </div>

        <!-- Data Table -->
        <v-data-table-server
          :loading="loading"
          :headers="headers"
          :items="items"
          :items-length="total"
          hover
          item-value="id"
          @update:options="loadItems"
          class="blog-table"
        >
          <!-- Image Column -->
          <template #item.image="{ item }">
            <v-img
              v-if="item.image"
              :src="item.image"
              width="80"
              height="60"
              cover
              class="rounded"
            />
            <span v-else class="text-grey">-</span>
          </template>

          <!-- Category -->
          <template #item.category="{ item }">
            <v-chip size="small" variant="tonal" color="primary">
              {{ item.category?.title || 'Uncategorized' }}
            </v-chip>
          </template>



          <!-- Dates -->
          <template #item.created_at="{ item }">
            <span class="text-caption">{{ dateFormate(item.created_at) }}</span>
          </template>

          <template #item.updated_at="{ item }">
            <span class="text-caption">{{ dateFormate(item.updated_at) }}</span>
          </template>

          <!-- Action Buttons -->
          <template #item.action="{ item }">
            <div class="d-flex gap-1">
              <v-btn
                icon="mdi-pencil"
                variant="text"
                color="primary"
                size="small"
                :to="`/admin/projects/edit/${item.id}`"
                title="Edit"
              ></v-btn>
              <v-btn
              icon="mdi-image-multiple"
              variant="text"
              color="primary"
              size="small"
              :to="`/admin/gallery/${item.id}`"
              title="Manage Gallery"
            ></v-btn>

              <v-btn
                icon="mdi-delete"
                variant="text"
                color="error"
                size="small"
                @click="deleteItem(item.id)"
                title="Delete"
              ></v-btn>
            </div>
          </template>
        </v-data-table-server>

      </v-card>
    </v-container>
  </div>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      filter: {
        search: null,
        length: 10,
        page: 1,
        offset: 0,
      },
      items: [],
      last_page: 1,
      total: 0,
      loading: false,

      headers: [
        { title: "ID", value: "id", width: "80px" },
        { title: "Image", key: "image", width: "100px", sortable: false },
        { title: "Title", value: "name" },
        { title: "slug", value: "slug", width: "120px" },
        { title: "author", value: "author", width: "130px" },
        { title: "Created", key: "created_at", width: "140px" },
        { title: "Action", key: "action", align: "end", width: "120px", sortable: false }
      ]
    };
  },

  mounted() {
    this.loadItems();
  },

  watch: {
    'filter.length'() {
      this.filter.page = 1;
      this.loadItems();
    },
    'filter.page'() {
      this.loadItems();
    }
  },

  methods: {
    dateFormate(date) {
      if (!date) return '-';
      return date.split('T')[0];
    },

    async loadItems() {
      this.loading = true;
      try {
        const res = await General.get("admin/projects", this.filter);
        
        this.items = res.data || [];
        this.total = Number(res.recordsTotal) || 0;
        this.last_page = Number(res.last_page) || 1;
        this.filter.offset = res.offset || 0;
      } catch (error) {
        console.error(error);
        this.$alertStore?.add(error.message || "Failed to load projects", "error");
      } finally {
        this.loading = false;
      }
    },

    async deleteItem(id) {
      if (!confirm("Are you sure you want to delete this blog?")) return;

      this.loading = true;
      try {
        await General.delete(`admin/projects/${id}`);
        this.$alertStore?.add("Project deleted successfully", "success");
        this.loadItems();
      } catch (error) {
        this.$alertStore?.add(error.message || "Delete failed", "error");
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>
.border {
  border: 1px solid rgba(255, 255, 255, 0.08) !important;
}

.border-b {
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.blog-table :deep(.v-data-table-header) th {
  font-weight: 600;
  color: rgba(255, 255, 255, 0.85) !important;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

:deep(.v-data-table__tr:hover) {
  background-color: rgba(0, 128, 255, 0.05) !important;
}
</style>