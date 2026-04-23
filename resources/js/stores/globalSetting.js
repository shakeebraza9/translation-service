import { defineStore } from 'pinia'
import General from '@/models/general.model'

export const useGlobalSettingStore = defineStore('globalSetting', {

  state: () => ({
    settings: {},
    loading: false
  }),

actions: {
  async loadSettings() {
    if (Object.keys(this.settings).length > 0) return;

    try {
      this.loading = true;
      const res = await General.get('/setting');
      
      const settingsMap = {};
      res.data.forEach(item => {
        settingsMap[item.key] = item.value;
      });

      this.settings = settingsMap;
      console.log("Settings Synced!");
    } catch (error) {
      console.error('Global Settings Load Error', error);
    } finally {
      this.loading = false;
    }
  }
},

  getters: {
    getSetting: (state) => {
      return (key) => state.settings[key] ?? null
    }
  }

})