import "./_group.css";
import { PlayCircle } from "lucide-react";
import { Button } from "@/components/ui/button";

export function MeshGradient() {
  return (
    <section className="relative w-full h-[540px] overflow-hidden" style={{ backgroundColor: "#080e22" }}>
      {/* Grid Background */}
      <div className="absolute inset-0 bg-grid-white" />

      {/* Mesh Gradient Blobs */}
      <div className="absolute inset-0 opacity-40 pointer-events-none">
        <div 
          className="absolute top-[10%] left-[20%] w-[300px] h-[300px] rounded-full mix-blend-screen filter blur-[80px] opacity-40 animate-mesh-float"
          style={{ backgroundColor: "#2563eb" }}
        />
        <div 
          className="absolute top-[20%] left-[40%] w-[400px] h-[400px] rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-mesh-float-delayed"
          style={{ backgroundColor: "#6366f1" }}
        />
        <div 
          className="absolute top-[-10%] left-[30%] w-[350px] h-[350px] rounded-full mix-blend-screen filter blur-[90px] opacity-40 animate-mesh-float-slow"
          style={{ backgroundColor: "#0ea5e9" }}
        />
      </div>

      <div className="relative z-10 h-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-center">
        <div className="max-w-[600px] flex flex-col items-start gap-6">
          
          {/* Eyebrow Pill */}
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm text-sm font-medium text-slate-300">
            <span className="flex h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
            Now serving 650+ cooperatives across Nepal
          </div>

          {/* H1 Title */}
          <h1 className="text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1]">
            <span className="block text-[0.85em] text-slate-200">Automate.</span>
            <span className="block text-[0.95em] text-slate-100 mt-1">Digitalize.</span>
            <span className="block text-blue-400 mt-1">Grow.</span>
          </h1>

          {/* Subtitle */}
          <p className="text-lg text-slate-400 leading-relaxed">
            The complete IT solutions platform for cooperatives, banks, and finance companies. Built for Nepal's financial sector.
          </p>

          {/* CTAs */}
          <div className="flex flex-wrap items-center gap-4 mt-2">
            <Button size="lg" className="bg-blue-600 hover:bg-blue-700 text-white rounded-full px-8 h-12 text-base font-semibold border-0">
              Book a Demo
            </Button>
            <button className="inline-flex items-center gap-2 text-slate-300 hover:text-white font-medium transition-colors px-4 py-3">
              <PlayCircle className="w-5 h-5 text-blue-400" />
              Watch a 2-min overview &rarr;
            </button>
          </div>

          {/* Trust Row */}
          <div className="flex items-center gap-4 mt-4 pt-4 border-t border-white/10 w-full">
            <div className="flex -space-x-2">
              <div className="w-8 h-8 rounded-full bg-blue-900 border-2 border-[#080e22] flex items-center justify-center text-[10px] font-bold text-white z-30">NR</div>
              <div className="w-8 h-8 rounded-full bg-indigo-900 border-2 border-[#080e22] flex items-center justify-center text-[10px] font-bold text-white z-20">SK</div>
              <div className="w-8 h-8 rounded-full bg-slate-800 border-2 border-[#080e22] flex items-center justify-center text-[10px] font-bold text-white z-10">PB</div>
            </div>
            <p className="text-sm text-slate-400">
              Join <strong className="text-slate-200 font-semibold">650+</strong> cooperatives already using our platform
            </p>
          </div>

        </div>
      </div>
    </section>
  );
}
