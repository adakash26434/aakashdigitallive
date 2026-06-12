import React from "react";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { ArrowRight, Zap, Users, Calendar, Package, ShieldCheck } from "lucide-react";
import "./_group.css";

export function CenteredBold() {
  return (
    <section className="relative w-full overflow-hidden flex flex-col items-center justify-center pt-24 pb-16 px-4" style={{ backgroundColor: "#0a1023", minHeight: "520px" }}>
      {/* Background Glow */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none" />
      
      {/* Animated Particles */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        <div className="particle"></div>
        <div className="particle"></div>
        <div className="particle"></div>
        <div className="particle"></div>
        <div className="particle"></div>
      </div>

      <div className="relative z-10 flex flex-col items-center text-center max-w-4xl mx-auto">
        <Badge variant="outline" className="mb-6 border-blue-500/30 bg-blue-500/10 text-blue-200 hover:bg-blue-500/20 transition-colors py-1.5 px-4 rounded-full text-sm font-medium">
          <Zap className="w-4 h-4 mr-2 text-blue-400" />
          Trusted by 650+ institutions across Nepal
        </Badge>

        <h1 className="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6 leading-tight">
          Software built for Nepal's <br className="hidden md:block" />
          <span className="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">Cooperatives</span>
        </h1>

        <p className="text-lg md:text-xl text-slate-300 mb-10 max-w-[520px] leading-relaxed">
          Digitalize your cooperative with our proven CBS software, digital banking solutions, and comprehensive IT automation.
        </p>

        <div className="flex flex-col sm:flex-row items-center gap-4 mb-16">
          <Button size="lg" className="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 h-14 rounded-full text-lg w-full sm:w-auto shadow-[0_0_20px_rgba(37,99,235,0.3)]" asChild>
            <a href="/contact.php">
              Book a Free Demo
              <ArrowRight className="ml-2 w-5 h-5" />
            </a>
          </Button>
          <Button size="lg" variant="ghost" className="text-blue-100 hover:text-white hover:bg-white/10 font-semibold px-8 h-14 rounded-full text-lg w-full sm:w-auto" asChild>
            <a href="/products.php">
              See our products
            </a>
          </Button>
        </div>

        {/* Stat Cards */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 w-full max-w-3xl">
          <div className="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
            <Users className="w-6 h-6 text-blue-400 mb-2" />
            <span className="text-2xl font-bold text-white mb-1">650+</span>
            <span className="text-xs text-slate-400 font-medium uppercase tracking-wider">Clients</span>
          </div>
          <div className="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
            <Calendar className="w-6 h-6 text-indigo-400 mb-2" />
            <span className="text-2xl font-bold text-white mb-1">10+</span>
            <span className="text-xs text-slate-400 font-medium uppercase tracking-wider">Years Exp</span>
          </div>
          <div className="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
            <Package className="w-6 h-6 text-blue-400 mb-2" />
            <span className="text-2xl font-bold text-white mb-1">7+</span>
            <span className="text-xs text-slate-400 font-medium uppercase tracking-wider">Products</span>
          </div>
          <div className="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
            <ShieldCheck className="w-6 h-6 text-indigo-400 mb-2" />
            <span className="text-2xl font-bold text-white mb-1">100%</span>
            <span className="text-xs text-slate-400 font-medium uppercase tracking-wider">Retention</span>
          </div>
        </div>
      </div>
    </section>
  );
}
