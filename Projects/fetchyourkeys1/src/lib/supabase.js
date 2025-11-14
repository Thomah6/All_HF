import { createClient } from '@supabase/supabase-js'

const supabaseUrl = 'https://qqlvwzkyjzsvoozbcxqq.supabase.co'
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFxbHZ3emt5anpzdm9vemJjeHFxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTY4MDcwMjUsImV4cCI6MjA3MjM4MzAyNX0.oIWfDEtVst_BQg_q4N5OqUxa8vM_EsOvsckq738DPIg'

export const supabase = createClient(supabaseUrl, supabaseAnonKey, {
    auth: {
        persistSession: true,
        autoRefreshToken: true,
        detectSessionInUrl: true
    }
})



