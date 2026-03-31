<template>
  <v-container fluid class="pa-8 pa-md-10">
    <!-- Welcome -->
    <v-row class="mb-8">
      <v-col cols="12">
        <h2 class="text-h4 font-weight-black text-white mb-1">
          Welcome back, <span class="text-primary">Shakeeb </span>!
        </h2>

      </v-col>
    </v-row>

    <!-- Stats Cards -->
    <v-row class="mb-8">
      <v-col 
        v-for="stat in stats" 
        :key="stat.title" 
        cols="12" 
        sm="6" 
        md="3"
      >
        <v-card 
          class="stats-card pa-6" 
          border 
          color="surface" 
          elevation="2"
        >
          <div class="d-flex align-center justify-space-between mb-5">
            <v-avatar :color="stat.color + '-darken-4'" size="56" rounded="lg">
              <v-icon :color="stat.color" size="32">{{ stat.icon }}</v-icon>
            </v-avatar>
            <v-chip 
              size="small" 
              color="success" 
              variant="tonal" 
              class="font-weight-bold"
            >
              +{{ stat.growth }}%
            </v-chip>
          </div>
          
          <div class="text-h3 font-weight-black text-white mb-1">{{ stat.value }}</div>
          <div class="text-caption text-light_text_on font-weight-medium uppercase tracking-wider">
            {{ stat.title }}
          </div>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <!-- Recent Projects -->
      <v-col cols="12" md="8">
        <v-card class="pa-6 h-full" border color="surface">
          <div class="d-flex align-center justify-space-between mb-6">
            <h3 class="text-h6 font-weight-bold text-white">Recent Projects</h3>
            <v-btn 
              to="/user/projects" 
              variant="text" 
              color="primary" 
              size="small" 
              append-icon="mdi-arrow-right"
            >
              View All
            </v-btn>
          </div>

          <v-table theme="dark" class="bg-transparent">
            <thead>
              <tr>
                <th class="text-left text-primary">Project Name</th>
                <th class="text-left text-primary">Category</th>
                <th class="text-left text-primary">Status</th>
                <th class="text-right text-primary">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in recentProjects" :key="item.name">
                <td class="font-weight-medium text-white">{{ item.name }}</td>
                <td><v-chip size="small" variant="outlined">{{ item.category }}</v-chip></td>
                <td>
                  <v-badge 
                    dot 
                    :color="item.status === 'Live' ? 'success' : item.status === 'Maintenance' ? 'warning' : 'grey'" 
                    inline
                  ></v-badge>
                  <span class="ml-2">{{ item.status }}</span>
                </td>
                <td class="text-right">
                  <v-btn icon="mdi-pencil-outline" variant="text" size="small" color="grey-lighten-2"></v-btn>
                </td>
              </tr>
            </tbody>
          </v-table>
        </v-card>
      </v-col>

      <!-- Latest Messages -->
      <v-col cols="12" md="4">
        <v-card class="pa-6 h-full" border color="surface">
          <h3 class="text-h6 font-weight-bold text-white mb-6">Latest Messages</h3>
          
          <v-list lines="two" bg-color="transparent" class="pa-0">
            <v-list-item
              v-for="msg in messages"
              :key="msg.id"
              class="px-0 mb-5 border-bottom-op"
            >
              <template v-slot:prepend>
                <v-avatar color="primary-darken-3" size="44">
                  <span class="text-white font-weight-medium">{{ msg.initials }}</span>
                </v-avatar>
              </template>
              
              <v-list-item-title class="text-white font-weight-medium">
                {{ msg.name }}
              </v-list-item-title>
              <v-list-item-subtitle class="text-light_text_on line-clamp-1">
                {{ msg.text }}
              </v-list-item-subtitle>

              <template v-slot:append>
                <v-btn icon="mdi-reply" variant="text" size="small" color="primary"></v-btn>
              </template>
            </v-list-item>
          </v-list>

          <v-btn block variant="tonal" color="primary" class="mt-6" size="small">
            Check All Inbox
          </v-btn>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'

const stats = [
  { title: 'Total Projects', value: '12', icon: 'mdi-folder-multiple-outline', color: 'primary', growth: '12' },
  { title: 'Blog Views', value: '1.2k', icon: 'mdi-eye-outline', color: 'info', growth: '25' },
  { title: 'New Messages', value: '08', icon: 'mdi-message-text-outline', color: 'warning', growth: '5' },
  { title: 'Active Services', value: '04', icon: 'mdi-server-network', color: 'success', growth: '0' },
]

const recentProjects = [
  { name: 'AUTOBILI LTD', category: 'E-commerce', status: 'Live' },
  { name: 'Crypto Wallet', category: 'Blockchain', status: 'Maintenance' },
  { name: 'Car Scraper', category: 'Python Tool', status: 'Live' },
  { name: 'Admin UI', category: 'Vue/Vuetify', status: 'Draft' },
]

const messages = [
  { id: 1, name: 'John Doe', initials: 'JD', text: 'Hey Ajoy, I loved your scraping tool...' },
  { id: 2, name: 'Sarah Khan', initials: 'SK', text: 'Are you available for a Laravel project?' },
  { id: 3, name: 'Mike Ross', initials: 'MR', text: 'Can we integrate Electrum with Python?' },
]
</script>

<style scoped>
.stats-card {
  border-radius: 20px !important;
  transition: all 0.3s ease;
  height: 100%;
}

.stats-card:hover {
  transform: translateY(-6px);
  border-color: #0080FF !important;
}

.border-bottom-op {
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

:deep(.v-table th) {
  font-size: 0.75rem !important;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
}
</style>