import axios from 'axios';
window.axios = axios;
import { constants } from 'fs'; // Import constants from 'fs'
import fsp from 'fs/promises';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
