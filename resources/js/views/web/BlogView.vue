<template>
  <v-container id="blog" fluid class="py-16 bg-background position-relative min-vh-100">
    <div class="blog-glow"></div>

    <v-container>
      <v-row class="mb-10" align="end">
        <v-col cols="12" md="8">
          <span class="text-primary font-weight-bold text-uppercase letter-spacing-2">Articles & News</span>
          <h2 class="text-h3 font-weight-black text-white mt-2">Latest <span class="text-primary">Insights</span></h2>
        </v-col>
        <v-col cols="12" md="4" class="text-md-right">
          <v-text-field
            v-model="search"
            prepend-inner-icon="mdi-magnify"
            label="Search articles..."
            variant="outlined"
            density="comfortable"
            color="primary"
            bg-color="inputBg"
            hide-details
            rounded="lg"
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row class="mb-12">
        <v-col cols="12">
          <v-card class="featured-card overflow-hidden" border="border" color="surface">
            <v-row no-gutters>
              <v-col cols="12" md="7">
                <v-img 
                  src="https://via.placeholder.com/800x450/0E1B2B/ffffff?text=Laravel+Vue+Integration" 
                  height="400" 
                  cover
                ></v-img>
              </v-col>
              <v-col cols="12" md="5" class="pa-8 d-flex flex-column justify-center">
                <v-chip color="primary" size="small" variant="flat" class="mb-4 w-fit">Featured</v-chip>
                <h3 class="text-h4 font-weight-bold text-white mb-4">Mastering Laravel & Vue.js Full-Stack Architecture</h3>
                <p class="text-light_text_on mb-6">
                  Deep dive into building scalable applications using Laravel as a robust API and Vue 3 with Pinia for state management.
                </p>
                <div class="d-flex align-center">
                  <v-avatar size="32" class="mr-3">
                    <v-img :src="avatarImage"></v-img>
                  </v-avatar>
                  <span class="text-caption text-white">AJOY Sarker • March 2026</span>
                </div>
                <v-btn color="primary" variant="text" append-icon="mdi-arrow-right" class="mt-6 px-0 w-fit font-weight-bold">
                  Read Article
                </v-btn>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>

      <v-row>
        <v-col v-for="post in filteredPosts" :key="post.id" cols="12" md="4" sm="6">
          <v-card class="blog-card h-full d-flex flex-column" border="border" color="surface">
            <v-img :src="post.image" height="220" cover></v-img>
            
            <v-card-text class="pa-6 flex-grow-1">
              <div class="d-flex justify-space-between mb-3">
                <span class="text-caption text-primary font-weight-bold">{{ post.category }}</span>
                <span class="text-caption text-light_text_on">{{ post.date }}</span>
              </div>
              <h4 class="text-h6 font-weight-bold text-white mb-3 leading-tight">{{ post.title }}</h4>
              <p class="text-body-2 text-light_text_on line-clamp-2">{{ post.excerpt }}</p>
            </v-card-text>

            <v-card-actions class="pa-6 pt-0">
              <v-btn variant="plain" color="primary" class="px-0 text-none font-weight-bold">
                Read More
              </v-btn>
              <v-spacer></v-spacer>
              <v-btn icon="mdi-share-variant-outline" variant="text" size="small" color="light"></v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script setup>
import { ref, computed } from 'vue';
import avatarImage from '@/assets/avatar.png';

const search = ref('');

const posts = [
  {
    id: 1,
    title: 'Automating Web Scraping with Selenium & Laravel',
    excerpt: 'How I built a high-performance scrapper for automotive auctions using Python and Laravel.',
    category: 'Development',
    date: 'March 15, 2026',
    image: 'https://via.placeholder.com/400x220/0E1B2B/ffffff?text=Web+Scraping'
  },
  {
    id: 2,
    title: 'Secure Crypto Wallet Integration in Vue 3',
    excerpt: 'Step-by-step guide to integrating Electrum API with modern frontend frameworks.',
    category: 'Crypto',
    date: 'Feb 28, 2026',
    image: 'https://via.placeholder.com/400x220/0E1B2B/ffffff?text=Crypto'
  },
  {
    id: 3,
    title: 'Optimizing Laravel Queries for Large Datasets',
    excerpt: 'Practical tips to improve your database performance using Eloquent and raw SQL.',
    category: 'Backend',
    date: 'Jan 10, 2026',
    image: 'https://via.placeholder.com/400x220/0E1B2B/ffffff?text=Database'
  }
];

const filteredPosts = computed(() => {
  return posts.filter(post => 
    post.title.toLowerCase().includes(search.value.toLowerCase()) ||
    post.category.toLowerCase().includes(search.value.toLowerCase())
  );
});
</script>

<style scoped>
.letter-spacing-2 { letter-spacing: 2px; }
.leading-tight { line-height: 1.3 !important; }
.w-fit { width: fit-content; }

.featured-card {
  border-radius: 24px !important;
  transition: transform 0.3s ease;
}

.blog-card {
  border-radius: 20px !important;
  transition: all 0.3s ease;
}

.blog-card:hover {
  transform: translateY(-8px);
  border-color: #0080FF !important;
}

.blog-glow {
  position: absolute;
  top: 10%;
  right: 0;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(0, 128, 255, 0.05) 0%, transparent 70%);
  z-index: 0;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;  
  overflow: hidden;
}

:deep(.v-field--variant-outlined) {
  border-radius: 12px !important;
}
</style>