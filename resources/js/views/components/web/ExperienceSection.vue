<template>
  <v-container id="experience" fluid class="py-16 bg-surface">
    <v-container>
      <div class="text-center mb-12">
        <span class="text-primary font-weight-bold text-uppercase letter-spacing-2">My Work Journey</span>
        <h2 class="text-h3 font-weight-black text-white mt-2">Work <span class="text-primary">Experience</span></h2>
      </div>

      <v-row justify="center">
        <v-col cols="12" lg="10">
          <v-timeline align="start" side="end" line-color="border" line-thickness="2">
            
            <v-timeline-item
              dot-color="primary"
              size="small"
              fill-dot
            >
              <template v-slot:opposite>
                <span class="text-h6 font-weight-bold text-primary">2025 - Present</span>
              </template>
              <v-card class="exp-card" border="border" variant="flat">
                <v-card-item>
                  <div class="d-flex justify-space-between align-center flex-wrap">
                    <v-card-title class="text-h5 font-weight-bold text-white px-0">
                      Full Stack Developer
                    </v-card-title>
                    <v-chip color="primary" size="small" variant="outlined" class="font-weight-bold">Fission Fox</v-chip>
                  </div>
                  <v-card-subtitle class="text-primary-lighten-1 mt-1 px-0">
                    Laravel, Vue.js & Python Specialist
                  </v-card-subtitle>
                </v-card-item>

                <v-card-text class="text-light_text_on pt-2">
                  <ul class="custom-list">
                    <li>Designed and developed full-stack web applications using <strong>Laravel & Vue.js</strong>.</li>
                    <li>Built and integrated <strong>RESTful APIs</strong> for dynamic data handling.</li>
                    <li>Implemented <strong>RBAC</strong> (Role-Based Access Control) and secure authentication.</li>
                    <li>Optimized <strong>MySQL</strong> queries for high-performance data scraping and storage.</li>
                  </ul>
                </v-card-text>
              </v-card>
            </v-timeline-item>

            <v-timeline-item
              dot-color="primaryDark"
              size="small"
            >
              <template v-slot:opposite>
                <span class="text-h6 font-weight-medium text-grey">1 Year</span>
              </template>
              <v-card class="exp-card" border="border" variant="flat">
                <v-card-item>
                  <div class="d-flex justify-space-between align-center flex-wrap">
                    <v-card-title class="text-h5 font-weight-bold text-white px-0">
                      PHP Laravel Developer
                    </v-card-title>
                    <v-chip color="border" size="small" variant="flat">Azam Solutions (Remote)</v-chip>
                  </div>
                </v-card-item>
                <v-card-text class="text-light_text_on">
                  Developed custom Laravel-based web applications following <strong>MVC architecture</strong>. 
                  Created reusable Vue components and handled complex database-driven features.
                </v-card-text>
              </v-card>
            </v-timeline-item>

            <v-timeline-item
              dot-color="border"
              size="small"
            >
              <template v-slot:opposite>
                <span class="text-h6 font-weight-medium text-grey">8 Months</span>
              </template>
              <v-card class="exp-card shadow-none" border="border" variant="flat" style="opacity: 0.8">
                <v-card-item>
                  <v-card-title class="text-h6 font-weight-bold text-white px-0">
                    Associated Developer PHP
                  </v-card-title>
                  <v-card-subtitle class="px-0">Interactive Media, Karachi</v-card-subtitle>
                </v-card-item>
                <v-card-text class="text-light_text_on pb-4">
                  Assisted in maintaining PHP applications, working with <strong>AJAX</strong>, SQL queries, and debugging features for client projects.
                </v-card-text>
              </v-card>
            </v-timeline-item>

          </v-timeline>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<style scoped>
.exp-card {
  background: #0E1B2B !important; /* Aapka background color */
  border-radius: 16px !important;
  transition: all 0.3s ease;
  margin-bottom: 20px;
}

.exp-card:hover {
  border-color: #0080FF !important;
  transform: translateX(5px);
}

.custom-list {
  padding-left: 18px;
  list-style-type: none;
}

.custom-list li {
  position: relative;
  margin-bottom: 8px;
  line-height: 1.6;
}

.custom-list li::before {
  content: "→";
  position: absolute;
  left: -20px;
  color: #0080FF;
  font-weight: bold;
}

.letter-spacing-2 {
  letter-spacing: 2px;
}

/* Responsive adjustment for mobile */
@media (max-width: 600px) {
  :deep(.v-timeline-item__opposite) {
    display: none;
  }
}
</style>