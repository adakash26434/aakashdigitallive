import React from 'react';
import { ArrowRight, CheckCircle2, BarChart3, Users, Building, Activity, LineChart, PieChart } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import './_group.css';

export function SplitLayout() {
  return (
    <div className="relative w-full min-h-[560px] bg-gradient-to-br from-[#0a1023] to-[#0f1f5c] overflow-hidden flex items-center justify-center py-16">
      {/* Background glow effects */}
      <div className="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-blue-600/20 blur-[120px] pointer-events-none" />
      <div className="absolute bottom-[-20%] right-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none" />
      
      <div className="container mx-auto px-4 max-w-6xl relative z-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Left Column - Content */}
          <div className="lg:col-span-7 flex flex-col gap-6 text-white text-left">
            <div className="animate-fade-up opacity-0">
              <Badge variant="outline" className="bg-blue-500/10 text-blue-300 border-blue-500/30 px-3 py-1 text-sm font-medium mb-4 rounded-full">
                🇳🇵 Nepal's #1 Cooperative Software
              </Badge>
            </div>
            
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] animate-fade-up opacity-0 animation-delay-100">
              Digitalize Your <span className="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Cooperative</span>
            </h1>
            
            <p className="text-lg md:text-xl text-blue-100/80 max-w-xl animate-fade-up opacity-0 animation-delay-200">
              Comprehensive IT solutions & CBS automation for cooperatives, banks, and finance companies across Nepal.
            </p>
            
            <div className="flex flex-wrap gap-4 mt-2 animate-fade-up opacity-0 animation-delay-300">
              <a href="/contact.php">
                <Button size="lg" className="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-8 shadow-[0_0_20px_rgba(37,99,235,0.4)] transition-all rounded-md h-12">
                  Book a free demo
                  <ArrowRight className="ml-2 h-4 w-4" />
                </Button>
              </a>
              <a href="/products.php">
                <Button size="lg" variant="outline" className="border-blue-500/30 bg-[#0a1023]/50 text-white hover:bg-blue-900/40 hover:text-white h-12 px-8 rounded-md transition-all backdrop-blur-sm">
                  See our products
                </Button>
              </a>
            </div>

            {/* Trust Pills */}
            <div className="flex flex-wrap gap-x-6 gap-y-3 mt-8 pt-6 border-t border-blue-800/30 animate-fade-up opacity-0 animation-delay-300">
              <div className="flex items-center gap-2">
                <div className="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center">
                  <Users className="h-4 w-4 text-blue-400" />
                </div>
                <div>
                  <div className="text-white font-bold text-sm">650+</div>
                  <div className="text-blue-200/60 text-xs">Happy Clients</div>
                </div>
              </div>
              <div className="flex items-center gap-2">
                <div className="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                  <CheckCircle2 className="h-4 w-4 text-indigo-400" />
                </div>
                <div>
                  <div className="text-white font-bold text-sm">10+ Years</div>
                  <div className="text-blue-200/60 text-xs">Experience</div>
                </div>
              </div>
              <div className="flex items-center gap-2">
                <div className="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                  <Activity className="h-4 w-4 text-emerald-400" />
                </div>
                <div>
                  <div className="text-white font-bold text-sm">100%</div>
                  <div className="text-blue-200/60 text-xs">Retention</div>
                </div>
              </div>
            </div>
          </div>

          {/* Right Column - Dashboard Card Mockup */}
          <div className="lg:col-span-5 relative hidden lg:block perspective-1000">
            {/* The Floating Card */}
            <div className="relative w-full aspect-[4/3] rounded-2xl border border-white/10 bg-[#0a1536]/80 backdrop-blur-xl shadow-2xl p-6 flex flex-col gap-6 animate-float-tilt transform rotate-4 z-20">
              
              {/* Card Header */}
              <div className="flex justify-between items-center pb-4 border-b border-white/5">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                    <Building className="h-5 w-5 text-white" />
                  </div>
                  <div>
                    <h3 className="text-white font-medium text-sm">CBS Dashboard</h3>
                    <div className="flex items-center gap-1.5 mt-1">
                      <div className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
                      <span className="text-emerald-400/80 text-[10px] font-medium tracking-wide uppercase">System Active</span>
                    </div>
                  </div>
                </div>
                <div className="flex gap-1.5">
                  <div className="w-3 h-3 rounded-full bg-white/10" />
                  <div className="w-3 h-3 rounded-full bg-white/10" />
                  <div className="w-3 h-3 rounded-full bg-white/10" />
                </div>
              </div>

              {/* Card Content - Stats Row */}
              <div className="grid grid-cols-3 gap-3">
                {[
                  { label: "Total Branches", value: "12", trend: "+2", icon: Building },
                  { label: "Active Members", value: "8,450", trend: "+120", icon: Users },
                  { label: "Daily Trans.", value: "NPR 4.2M", trend: "+15%", icon: BarChart3 },
                ].map((stat, i) => (
                  <div key={i} className="bg-white/5 rounded-xl p-3 border border-white/5 flex flex-col gap-2">
                    <div className="flex justify-between items-start">
                      <stat.icon className="h-4 w-4 text-blue-400" />
                      <span className="text-emerald-400 text-[10px] font-semibold bg-emerald-400/10 px-1.5 py-0.5 rounded">{stat.trend}</span>
                    </div>
                    <div>
                      <div className="text-white font-bold text-sm sm:text-base">{stat.value}</div>
                      <div className="text-white/40 text-[10px]">{stat.label}</div>
                    </div>
                  </div>
                ))}
              </div>

              {/* Card Content - Chart Area */}
              <div className="flex-1 bg-gradient-to-t from-white/5 to-transparent rounded-xl border border-white/5 relative overflow-hidden flex items-end p-4">
                <div className="absolute top-4 left-4 flex gap-4">
                  <div className="flex items-center gap-2">
                    <div className="w-2 h-2 rounded-full bg-blue-500" />
                    <span className="text-white/50 text-[10px]">Deposits</span>
                  </div>
                  <div className="flex items-center gap-2">
                    <div className="w-2 h-2 rounded-full bg-indigo-500" />
                    <span className="text-white/50 text-[10px]">Loans</span>
                  </div>
                </div>
                
                {/* Fake SVG Chart */}
                <div className="w-full h-[60%] flex items-end justify-between gap-2 mt-auto">
                  {[40, 65, 45, 80, 55, 90, 75].map((h, i) => (
                    <div key={i} className="w-full flex gap-1 items-end h-full group">
                      <div className="w-1/2 bg-blue-500/80 rounded-t-sm transition-all duration-500 group-hover:bg-blue-400" style={{ height: `${h}%` }} />
                      <div className="w-1/2 bg-indigo-500/80 rounded-t-sm transition-all duration-500 group-hover:bg-indigo-400" style={{ height: `${h * 0.7}%` }} />
                    </div>
                  ))}
                </div>
              </div>

            </div>
            
            {/* Decoration Elements behind card */}
            <div className="absolute top-[-20px] right-[-20px] w-24 h-24 bg-blue-500/20 rounded-full blur-2xl z-0" />
            <div className="absolute bottom-[-30px] left-[-30px] w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl z-0" />
            
            {/* Small floating elements */}
            <div className="absolute top-[10%] right-[-10%] bg-[#0a1536] border border-white/10 p-2 rounded-lg shadow-xl animate-float-tilt z-30" style={{ animationDelay: '1s' }}>
              <LineChart className="h-5 w-5 text-indigo-400" />
            </div>
            <div className="absolute bottom-[20%] left-[-10%] bg-[#0a1536] border border-white/10 p-2 rounded-lg shadow-xl animate-float-tilt z-30" style={{ animationDelay: '2s' }}>
              <PieChart className="h-5 w-5 text-emerald-400" />
            </div>
          </div>
          
        </div>
      </div>
    </div>
  );
}
