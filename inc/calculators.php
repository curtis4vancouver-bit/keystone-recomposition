<?php
/**
 * Keystone Recomposition - Custom Interactive Calculators & Content Shortcodes
 * 
 * Provides:
 * - [keystone_glp1_calculator] : Mounjaro / Zepbound / Ozempic KwikPen Click-to-mg Math & 5-Day PK Scaler
 * - [keystone_peptide_calculator] : FDA Category 1 Peptide Reconstitution & U-100 Syringe Visualizer
 * - [keystone_gear_portal] : Curated Biohacking, Equipment & Discount Codes Portal
 * - [keystone_sonic_universe] : Spotify Discography & YouTube OAC Media Center
 * - [keystone_kitchen_recipes] : High-Protein Metabolic Recomposition Recipes
 * - [keystone_founder_story] : Wayne Stevenson Master Universe Profile
 * 
 * Stamped: August 2026 - Wayne Stevenson & Keystone Orchestration Engine
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. GLP-1 KwikPen Click-to-mg & Pharmacokinetic Scaler Shortcode
 */
function keystone_glp1_calculator_shortcode() {
    ob_start();
    ?>
    <div class="keystone-tool-card" id="glp1-calculator">
        <div class="tool-header">
            <span class="tool-badge">RESEARCH CASE STUDY PROTOCOL</span>
            <h2 class="tool-title">GLP-1 KwikPen Click-to-mg &amp; Pharmacokinetic Scaler</h2>
            <p class="tool-subtitle">Precision click conversion, dose concentration math, and 5-day vs. 7-day half-life micro-dosing modeling for Mounjaro®, Zepbound®, and Ozempic® multi-dose pens.</p>
        </div>

        <!-- Prominent Legally Binding Medical Disclaimer Banner -->
        <div class="keystone-disclaimer-banner" style="background: rgba(196,162,101,0.08); border: 1px solid rgba(196,162,101,0.4); border-left: 4px solid #C4A265; border-radius: 8px; padding: 14px 20px; margin: 0 0 24px 0;">
            <h4 style="font-family:'Outfit', sans-serif; font-size: 13px; font-weight: 800; color: #C4A265; text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 6px 0; display:flex; align-items:center; gap:8px;">
                <span>⚠️</span> MEDICAL DISCLAIMER &amp; RESEARCH VERIFICATION NOTICE
            </h4>
            <p style="font-size: 13px; line-height: 1.6; color: #D1D5DB; margin: 0; font-weight: 600;">
                For Educational and Research Verification Only. Not Medical Advice. Consult a Licensed Physician.
            </p>
        </div>

        <div class="calculator-grid">
            <!-- Left Column: Interactive Inputs -->
            <div class="calc-control-panel">
                <!-- Compound Selector -->
                <div class="calc-group">
                    <label class="calc-label">Select Active Compound &amp; Half-Life:</label>
                    <div class="protocol-interval-grid">
                        <button type="button" class="compound-btn active" data-compound="tirzepatide" data-halflife="5.0">
                            <strong>Tirzepatide (Mounjaro® / Zepbound®)</strong>
                            <span>Mean Half-Life ≈ 5.0 Days (120 Hours)</span>
                        </button>
                        <button type="button" class="compound-btn" data-compound="semaglutide" data-halflife="7.0">
                            <strong>Semaglutide (Ozempic® / Wegovy®)</strong>
                            <span>Mean Half-Life ≈ 7.0 Days (168 Hours)</span>
                        </button>
                    </div>
                </div>

                <!-- Dosing Interval Selector (5-Day vs 7-Day) -->
                <div class="calc-group">
                    <label class="calc-label">Select Dosing Schedule / Cycle Interval:</label>
                    <div class="schedule-selector-grid">
                        <button type="button" class="interval-btn active" data-interval="5">
                            <span class="interval-icon">⚡</span>
                            <strong>5-Day Micro-Dose Protocol</strong>
                            <small>Smooth Trough &amp; Zero Hunger Spikes</small>
                        </button>
                        <button type="button" class="interval-btn" data-interval="7">
                            <span class="interval-icon">📅</span>
                            <strong>7-Day Standard Weekly Protocol</strong>
                            <small>Conventional Once-Weekly Schedule</small>
                        </button>
                    </div>
                </div>

                <!-- Pen Strength Selector -->
                <div class="calc-group">
                    <label for="pen-strength" class="calc-label">Select Pen Strength (Labeled mg per full dose):</label>
                    <div class="strength-selector-grid">
                        <button type="button" class="strength-btn" data-mg="2.5">2.5 mg</button>
                        <button type="button" class="strength-btn active" data-mg="5.0">5.0 mg</button>
                        <button type="button" class="strength-btn" data-mg="7.5">7.5 mg</button>
                        <button type="button" class="strength-btn" data-mg="10.0">10.0 mg</button>
                        <button type="button" class="strength-btn" data-mg="12.5">12.5 mg</button>
                        <button type="button" class="strength-btn" data-mg="15.0">15.0 mg</button>
                    </div>
                </div>

                <!-- Click Slider -->
                <div class="calc-group">
                    <div class="label-row">
                        <label for="click-slider" class="calc-label">Dial Clicks (0 to 60 Clicks):</label>
                        <span class="click-display" id="click-val-display">30 Clicks</span>
                    </div>
                    <input type="range" id="click-slider" min="0" max="60" value="30" step="1" class="gold-range-slider">
                    <div class="slider-ticks">
                        <span>0 (0 mL)</span>
                        <span>15 (0.15 mL)</span>
                        <span>30 (0.30 mL)</span>
                        <span>45 (0.45 mL)</span>
                        <span>60 (0.60 mL)</span>
                    </div>
                </div>

                <!-- Target Dose Matcher -->
                <div class="calc-group">
                    <label class="calc-label">Or Dial Clicks to Match Desired Weekly Target Dose (mg):</label>
                    <div class="input-with-button">
                        <input type="number" id="target-dose-input" min="0.5" max="15.0" step="0.25" placeholder="e.g. 5.0" class="gold-input">
                        <button type="button" id="calc-clicks-btn" class="gold-action-btn">Calculate Clicks</button>
                    </div>
                    <small style="display:block; color:#9CA3AF; margin-top:6px; font-size:11px;" id="target-matcher-hint">Auto-scales injection dose for 5-day cycle: 5.0 mg/wk → 3.57 mg every 5 days (43 clicks).</small>
                </div>
            </div>

            <!-- Right Column: Real-Time Results & Pharmacokinetic Dial -->
            <div class="calc-results-panel">
                <div class="results-card">
                    <h3 class="results-header">Calculated Injection &amp; Pharmacokinetic Metrics</h3>
                    
                    <div class="metric-row highlight-metric">
                        <span class="metric-label">Injected Dose per Shot:</span>
                        <span class="metric-value gold-text" id="res-delivered-mg">2.50 mg</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Equivalent 7-Day Exposure:</span>
                        <span class="metric-value gold-text" id="res-weekly-equivalent">3.50 mg / week</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Injection Volume:</span>
                        <span class="metric-value" id="res-delivered-ml">0.30 mL (30 units)</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Single Click Value:</span>
                        <span class="metric-value" id="res-single-click">0.0833 mg / click</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Cartridge Capacity:</span>
                        <span class="metric-value" id="res-cartridge-doses">8.0 shots at this setting</span>
                    </div>
                </div>

                <!-- Pharmacokinetic Dynamics Card -->
                <div class="results-card secondary-card">
                    <h3 class="results-header" id="pk-dynamics-title">⚡ 5-Day Pharmacokinetic Advantage</h3>
                    <div class="metric-row">
                        <span class="metric-label">Active Schedule:</span>
                        <span class="metric-value" id="res-active-schedule" style="color:#C4A265; font-weight:700;">Every 5 Days (⚡ Micro-Dose)</span>
                    </div>
                    <div class="metric-row highlight-metric">
                        <span class="metric-label">Stabilized HIGH (Peak C_max):</span>
                        <span class="metric-value" id="res-steady-high" style="color:#F59E0B; font-weight:800; font-size:16px;">5.00 mg (Peak)</span>
                    </div>
                    <div class="metric-row highlight-metric">
                        <span class="metric-label">Stabilized LOW (Trough C_min):</span>
                        <span class="metric-value" id="res-steady-low" style="color:#10B981; font-weight:800; font-size:16px;">2.50 mg (Trough)</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Accumulation Factor (R_acc):</span>
                        <span class="metric-value" id="res-accumulation-factor" style="color:#C4A265; font-weight:700;">2.00x</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Peak-to-Trough Fluctuation:</span>
                        <span class="metric-value" id="res-steady-swing">Δ 2.50 mg (2.00x)</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Trough Level at Next Shot:</span>
                        <span class="metric-value" id="res-trough-retention" style="color:#10B981; font-weight:700;">50.0% Remaining (Stable)</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Late-Cycle Hunger Status:</span>
                        <span class="metric-value" id="res-hunger-status" style="color:#10B981;">Zero Late Food Noise</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Master KwikPen Conversion Matrix Table -->
        <div class="table-container">
            <h3 class="table-title">Universal KwikPen Click-to-Dose Conversion Matrix</h3>
            <div class="table-responsive">
                <table class="keystone-table">
                    <thead>
                        <tr>
                            <th>Target Dose</th>
                            <th>2.5 mg Pen</th>
                            <th>5.0 mg Pen</th>
                            <th>7.5 mg Pen</th>
                            <th>10.0 mg Pen</th>
                            <th>12.5 mg Pen</th>
                            <th>15.0 mg Pen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>1.25 mg</strong></td><td>30 clicks</td><td>15 clicks</td><td>10 clicks</td><td>8 clicks</td><td>6 clicks</td><td>5 clicks</td></tr>
                        <tr><td><strong>2.50 mg</strong></td><td><span class="gold-badge">60 clicks</span></td><td>30 clicks</td><td>20 clicks</td><td>15 clicks</td><td>12 clicks</td><td>10 clicks</td></tr>
                        <tr><td><strong>3.75 mg</strong></td><td>—</td><td>45 clicks</td><td>30 clicks</td><td>23 clicks</td><td>18 clicks</td><td>15 clicks</td></tr>
                        <tr><td><strong>5.00 mg</strong></td><td>—</td><td><span class="gold-badge">60 clicks</span></td><td>40 clicks</td><td>30 clicks</td><td>24 clicks</td><td>20 clicks</td></tr>
                        <tr><td><strong>7.50 mg</strong></td><td>—</td><td>—</td><td><span class="gold-badge">60 clicks</span></td><td>45 clicks</td><td>36 clicks</td><td>30 clicks</td></tr>
                        <tr><td><strong>10.00 mg</strong></td><td>—</td><td>—</td><td>—</td><td><span class="gold-badge">60 clicks</span></td><td>48 clicks</td><td>40 clicks</td></tr>
                        <tr><td><strong>12.50 mg</strong></td><td>—</td><td>—</td><td>—</td><td>—</td><td><span class="gold-badge">60 clicks</span></td><td>50 clicks</td></tr>
                        <tr><td><strong>15.00 mg</strong></td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td><span class="gold-badge">60 clicks</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Legal & Fiduciary Disclaimer -->
        <div class="keystone-disclaimer-box">
            <h4 class="disclaimer-title">⚠️ Personal Case Study &amp; Educational Tool Only — Talk to Your Doctor</h4>
            <p class="disclaimer-text"><strong>For Educational and Research Verification Only. Not Medical Advice. Consult a Licensed Physician.</strong> This calculator, mathematical formulas, and data tables represent <strong>personal observational case-study modeling</strong> and pharmacokinetic calculations documented by Wayne Stevenson. <strong>This tool is published strictly for educational and mathematical demonstration purposes and does NOT constitute medical advice, diagnosis, treatment recommendations, or prescription administration guidelines.</strong> Counting clicks on multi-dose pens is an off-label case study technique and is not endorsed by pharmaceutical manufacturers. <strong>Always talk to your licensed medical doctor or endocrinologist before modifying, starting, or administering any prescription medication or metabolic protocol.</strong></p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_glp1_calculator', 'keystone_glp1_calculator_shortcode' );

/**
 * 2. FDA Category 1 Peptide Reconstitution Calculator Shortcode
 */
function keystone_peptide_calculator_shortcode() {
    ob_start();
    ?>
    <div class="keystone-tool-card" id="peptide-calculator">
        <div class="tool-header">
            <span class="tool-badge">LABORATORY MATHEMATICAL BENCHMARK</span>
            <h2 class="tool-title">Peptide Reconstitution &amp; U-100 Syringe Calculator</h2>
            <p class="tool-subtitle">Accurate dilution math, concentration curves, and insulin syringe unit calibrations for FDA Category 1 review peptides (BPC-157, TB-500, CJC-1295, Ipamorelin, GHK-Cu, NAD+, Glutathione).</p>
        </div>

        <!-- Prominent Legally Binding Medical Disclaimer Banner -->
        <div class="keystone-disclaimer-banner" style="background: rgba(196,162,101,0.08); border: 1px solid rgba(196,162,101,0.4); border-left: 4px solid #C4A265; border-radius: 8px; padding: 14px 20px; margin: 0 0 24px 0;">
            <h4 style="font-family:'Outfit', sans-serif; font-size: 13px; font-weight: 800; color: #C4A265; text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 6px 0; display:flex; align-items:center; gap:8px;">
                <span>⚠️</span> MEDICAL DISCLAIMER &amp; RESEARCH NOTICE
            </h4>
            <p style="font-size: 13px; line-height: 1.6; color: #D1D5DB; margin: 0; font-weight: 600;">
                For Educational and Research Verification Only. Not Medical Advice. Consult a Licensed Physician.
            </p>
        </div>

        <div class="calculator-grid">
            <!-- Left Column: Controls -->
            <div class="calc-control-panel">
                <div class="calc-group">
                    <label class="calc-label">Vial Size (Peptide Mass in Milligrams):</label>
                    <div class="strength-selector-grid vial-selector-grid">
                        <button type="button" class="vial-btn" data-vial="2">2 mg</button>
                        <button type="button" class="vial-btn active" data-vial="5">5 mg</button>
                        <button type="button" class="vial-btn" data-vial="10">10 mg</button>
                        <button type="button" class="vial-btn" data-vial="15">15 mg</button>
                    </div>
                </div>

                <div class="calc-group">
                    <div class="label-row">
                        <label for="bac-slider" class="calc-label">Bacteriostatic Water Added (mL):</label>
                        <span class="click-display" id="bac-val-display">2.0 mL</span>
                    </div>
                    <input type="range" id="bac-slider" min="0.5" max="5.0" value="2.0" step="0.5" class="gold-range-slider">
                    <div class="slider-ticks">
                        <span>0.5 mL</span>
                        <span>1.0 mL</span>
                        <span>2.0 mL</span>
                        <span>3.0 mL</span>
                        <span>5.0 mL</span>
                    </div>
                </div>

                <div class="calc-group">
                    <label for="peptide-target-dose" class="calc-label">Target Research Dose (Micrograms / mcg):</label>
                    <div class="input-with-button">
                        <input type="number" id="peptide-target-dose" min="50" max="5000" step="50" value="250" class="gold-input">
                        <span class="input-suffix">mcg</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Results & Syringe Visualization -->
            <div class="calc-results-panel">
                <div class="results-card">
                    <h3 class="results-header">Reconstitution Metrics</h3>
                    
                    <div class="metric-row highlight-metric">
                        <span class="metric-label">Draw to Syringe Tick:</span>
                        <span class="metric-value gold-text" id="res-syringe-units">10.0 Units</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Volume to Inject:</span>
                        <span class="metric-value" id="res-pep-volume">0.10 mL</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Solution Concentration:</span>
                        <span class="metric-value" id="res-pep-concentration">2,500 mcg/mL (2.5 mg/mL)</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Dose per Single Unit (0.01 mL):</span>
                        <span class="metric-value" id="res-pep-unit-value">25.0 mcg / unit</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Total Doses per Vial:</span>
                        <span class="metric-value" id="res-pep-total-doses">20 doses at 250 mcg</span>
                    </div>
                </div>

                <!-- Visual U-100 Syringe Diagram -->
                <div class="syringe-visual-container">
                    <h4 class="syringe-title">U-100 Syringe Scale (100 Units = 1.0 mL)</h4>
                    <div class="syringe-barrel">
                        <div class="syringe-fill" id="syringe-fill-bar" style="width: 10%;"></div>
                        <div class="syringe-marker marker-0">0</div>
                        <div class="syringe-marker marker-25">25</div>
                        <div class="syringe-marker marker-50">50</div>
                        <div class="syringe-marker marker-75">75</div>
                        <div class="syringe-marker marker-100">100</div>
                    </div>
                    <p class="syringe-caption">Highlighted fill level indicates exact liquid draw level (<span id="syringe-caption-units">10 Units</span>).</p>
                </div>
            </div>
        </div>

        <!-- Reference Table -->
        <div class="table-container">
            <h3 class="table-title">Standard 5 mg &amp; 10 mg Reconstitution Benchmarks (U-100 Syringe)</h3>
            <div class="table-responsive">
                <table class="keystone-table">
                    <thead>
                        <tr>
                            <th>Vial Size &amp; BAC Volume</th>
                            <th>Concentration</th>
                            <th>100 mcg Dose</th>
                            <th>250 mcg Dose</th>
                            <th>500 mcg Dose</th>
                            <th>1,000 mcg Dose</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>5 mg + 1.0 mL BAC</strong></td><td>5,000 mcg/mL</td><td>2.0 Units</td><td>5.0 Units</td><td>10.0 Units</td><td>20.0 Units</td></tr>
                        <tr><td><strong>5 mg + 2.0 mL BAC</strong></td><td>2,500 mcg/mL</td><td>4.0 Units</td><td><span class="gold-badge">10.0 Units</span></td><td>20.0 Units</td><td>40.0 Units</td></tr>
                        <tr><td><strong>5 mg + 3.0 mL BAC</strong></td><td>1,667 mcg/mL</td><td>6.0 Units</td><td>15.0 Units</td><td>30.0 Units</td><td>60.0 Units</td></tr>
                        <tr><td><strong>10 mg + 2.0 mL BAC</strong></td><td>5,000 mcg/mL</td><td>1.0 Unit</td><td>5.0 Units</td><td>10.0 Units</td><td>20.0 Units</td></tr>
                        <tr><td><strong>10 mg + 3.0 mL BAC</strong></td><td>3,333 mcg/mL</td><td>3.0 Units</td><td>7.5 Units</td><td>15.0 Units</td><td>30.0 Units</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="keystone-disclaimer-box">
            <h4 class="disclaimer-title">⚠️ Personal Case Study &amp; Educational Benchmark Only — Talk to Your Doctor</h4>
            <p class="disclaimer-text"><strong>For Educational and Research Verification Only. Not Medical Advice. Consult a Licensed Physician.</strong> This calculator and dilution reference table are provided strictly for <strong>educational, biochemical, and in-vitro laboratory calculation modeling</strong>. <strong>This tool does NOT provide medical advice, diagnosis, or self-administration dosing.</strong> Under 21 CFR § 312.160 and FDA compounding frameworks, experimental peptide compounds are evaluated for scientific research purposes. <strong>Always talk to your licensed physician or medical doctor before starting, handling, or administering any peptide, cellular, or pharmacological protocol.</strong> Store reconstituted solutions at 2–8°C in sterile conditions.</p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_peptide_calculator', 'keystone_peptide_calculator_shortcode' );

/**
 * 3. Curated Gear, Biohacking Tools & Discount Codes Portal Shortcode
 */
function keystone_gear_portal_shortcode() {
    ob_start();
    ?>
    <div class="keystone-gear-portal" id="recommended-gear">
        <div class="tool-header text-center">
            <span class="tool-badge">TESTED INFRASTRUCTURE</span>
            <h2 class="tool-title">Curated Gear, Biohacking Hardware &amp; Partner Codes</h2>
            <p class="tool-subtitle">The exact tools, metabolic monitors, laboratory reconstitution supplies, and audio hardware Wayne Stevenson uses daily across the 48-lb recomposition protocol.</p>
        </div>

        <div class="gear-categories-grid">
            <!-- Card 1: CGM & Metabolic Scanners -->
            <div class="gear-card">
                <div class="gear-badge">METABOLIC TRACKING</div>
                <h3 class="gear-card-title">Continuous Glucose Monitors &amp; Ketone Scanners</h3>
                <p class="gear-card-desc">Real-time interstitial glucose telemetry for pinpointing insulin sensitivity spikes, post-workout glycemic clearance, and GLP-1 carb thresholds.</p>
                <div class="gear-code-box">
                    <span class="code-label">Exclusive Partner Code:</span>
                    <span class="code-value">KEYSTONE20</span>
                </div>
                <div class="gear-footer">
                    <a href="https://keystonerecomposition.com/cgm-protocol" class="gold-action-btn full-width" style="color: #000000 !important; font-weight: 800 !important; text-decoration: none !important;" target="_blank" rel="nofollow noopener">View Sensor Protocol →</a>
                </div>
            </div>

            <!-- Card 2: Laboratory Reconstitution Accessories -->
            <div class="gear-card">
                <div class="gear-badge">LABORATORY ACCESSORIES</div>
                <h3 class="gear-card-title">Sterile Reconstitution &amp; Precision Micro-Syringes</h3>
                <p class="gear-card-desc">USP-grade bacteriostatic water, 31-gauge ultra-fine U-100 precision syringes, sterile amber storage vials, and alcohol prep cartridges.</p>
                <div class="gear-code-box">
                    <span class="code-label">Exclusive Partner Code:</span>
                    <span class="code-value">KEYSTONELAB</span>
                </div>
                <div class="gear-footer">
                    <a href="https://keystonerecomposition.com/lab-gear" class="gold-action-btn full-width" style="color: #000000 !important; font-weight: 800 !important; text-decoration: none !important;" target="_blank" rel="nofollow noopener">View Sterile Supplies →</a>
                </div>
            </div>

            <!-- Card 3: Cold Plunge & Contrast Recovery -->
            <div class="gear-card">
                <div class="gear-badge">COLD THERAPY</div>
                <h3 class="gear-card-title">Alpine Cold Plunge &amp; Infrared Contrast Systems</h3>
                <p class="gear-card-desc">Commercial 0.5 HP chilling systems maintaining 38°F (3.3°C) for dopamine upregulation, brown adipose tissue (BAT) thermogenesis, and rapid CNS recovery.</p>
                <div class="gear-code-box">
                    <span class="code-label">Exclusive Partner Code:</span>
                    <span class="code-value">KEYSTONEPLUNGE</span>
                </div>
                <div class="gear-footer">
                    <a href="https://keystonerecomposition.com/cold-plunge" class="gold-action-btn full-width" style="color: #000000 !important; font-weight: 800 !important; text-decoration: none !important;" target="_blank" rel="nofollow noopener">Explore Cold Tubs →</a>
                </div>
            </div>

            <!-- Card 4: Audio Hardware & Training Monitors -->
            <div class="gear-card">
                <div class="gear-badge">SOUND DESIGN</div>
                <h3 class="gear-card-title">Studio Reference Monitors &amp; Gym Acoustic Headphones</h3>
                <p class="gear-card-desc">High-output planar magnetic headphones and studio subwoofers engineered for deep work focus and heavy compound lifts with the Keystone Spotify catalog.</p>
                <div class="gear-code-box">
                    <span class="code-label">Exclusive Partner Code:</span>
                    <span class="code-value">KEYSTONESOUND</span>
                </div>
                <div class="gear-footer">
                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="gold-action-btn full-width" style="color: #000000 !important; font-weight: 800 !important; text-decoration: none !important;" target="_blank" rel="noopener">Listen on Spotify →</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_gear_portal', 'keystone_gear_portal_shortcode' );

/**
 * 4. Sonic Universe / Spotify Discography Shortcode
 */
function keystone_sonic_universe_shortcode() {
    ob_start();
    ?>
    <div class="keystone-sonic-hub" id="sonic-universe-hub">
        <div class="tool-header text-center">
            <span class="tool-badge">OFFICIAL ARTIST CHANNEL</span>
            <h2 class="tool-title">The Sonic Universe: Sound Design for Deep Work &amp; Heavy Training</h2>
            <p class="tool-subtitle">Original electronic compositions and high-energy workout soundtracks produced by Wayne Stevenson. Stream official albums and tracks directly on Spotify and YouTube Music.</p>
        </div>

        <div class="discography-grid">
            <!-- Album 1: Concrete Foundations -->
            <div class="album-card">
                <div class="album-art-wrap">
                    <img src="https://i0.wp.com/keystonerecomposition.com/wp-content/uploads/2026/05/Barbell_on_squat_rack35_202605021316.jpeg?w=600&ssl=1" alt="Concrete Foundations Album Cover" class="album-art">
                    <span class="album-tag">ALBUM RELEASE</span>
                </div>
                <div class="album-info">
                    <h3 class="album-title">Concrete Foundations</h3>
                    <p class="album-sub">High-End Fitness Music • Raw Power Strength</p>
                    <p class="album-desc">Heavy basslines, driving synth arpeggios, and 126 BPM focus cadences engineered to lock in maximum motor unit recruitment during compound resistance training.</p>
                    <div class="album-actions">
                        <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="spotify-btn" target="_blank" rel="noopener">
                            <span class="spotify-icon">🟢</span> Stream on Spotify
                        </a>
                        <a href="https://www.youtube.com/@KeyStoneRecomposition" class="youtube-btn" target="_blank" rel="noopener">
                            <span class="yt-icon">▶</span> Watch on YouTube OAC
                        </a>
                    </div>
                </div>
            </div>

            <!-- Album 2: Resonantia -->
            <div class="album-card">
                <div class="album-art-wrap">
                    <img src="https://i0.wp.com/keystonerecomposition.com/wp-content/uploads/2026/05/Man_performing_incline_press1_202605021316.jpeg?w=600&ssl=1" alt="Resonantia Album Cover" class="album-art">
                    <span class="album-tag">ALBUM RELEASE</span>
                </div>
                <div class="album-info">
                    <h3 class="album-title">Resonantia: 10 Frequencies of the Rebuild</h3>
                    <p class="album-sub">Deep House • Progressive Biohacking Score</p>
                    <p class="album-desc">10 atmospheric tracks mapping the psychological journey through metabolic discipline, fasting windows, and high-stakes executive execution.</p>
                    <div class="album-actions">
                        <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="spotify-btn" target="_blank" rel="noopener">
                            <span class="spotify-icon">🟢</span> Stream on Spotify
                        </a>
                        <a href="https://www.youtube.com/@KeyStoneRecomposition" class="youtube-btn" target="_blank" rel="noopener">
                            <span class="yt-icon">▶</span> Watch on YouTube OAC
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Tracks -->
        <div class="featured-tracks-box">
            <h3 class="tracks-header">Featured Singles &amp; Original Scores</h3>
            <div class="tracks-list">
                <div class="track-item">
                    <span class="track-num">01</span>
                    <div class="track-meta">
                        <span class="track-name">The 205 Marker</span>
                        <span class="track-detail">ISRC Registered • 128 BPM Deep House</span>
                    </div>
                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="track-link" target="_blank" rel="noopener">Play →</a>
                </div>
                <div class="track-item">
                    <span class="track-num">02</span>
                    <div class="track-meta">
                        <span class="track-name">The Foundation (Original Score)</span>
                        <span class="track-detail">Official Brand Anthem • Cinematic Bass</span>
                    </div>
                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="track-link" target="_blank" rel="noopener">Play →</a>
                </div>
                <div class="track-item">
                    <span class="track-num">03</span>
                    <div class="track-meta">
                        <span class="track-name">The Blueprint (Acoustic &amp; Synth Mix)</span>
                        <span class="track-detail">Focus Protocol • 124 BPM</span>
                    </div>
                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="track-link" target="_blank" rel="noopener">Play →</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_sonic_universe', 'keystone_sonic_universe_shortcode' );

/**
 * 5. High-Protein Kitchen Recipes Shortcode
 */
function keystone_kitchen_recipes_shortcode() {
    ob_start();
    ?>
    <div class="keystone-kitchen-hub" id="kitchen-hub">
        <div class="tool-header text-center">
            <span class="tool-badge">METABOLIC NUTRITION</span>
            <h2 class="tool-title">The Kitchen: Precision Macro Recipes for GLP-1 Muscle Preservation</h2>
            <p class="tool-subtitle">High-protein, low-glycemic, anti-inflammatory nutrition engineered to preserve lean tissue during rapid fat loss and maintain a 210-lb athletic set-point.</p>
        </div>

        <div class="recipes-grid">
            <!-- Recipe 1 -->
            <div class="recipe-card">
                <div class="recipe-header">
                    <span class="recipe-type">HEAVY RECOVERY DINNER</span>
                    <h3 class="recipe-title">48-Hour Set-Point Ribeye &amp; Roasted Bone Marrow Skillet</h3>
                </div>
                <div class="macro-bar">
                    <div class="macro-item"><span class="m-val">72g</span><span class="m-lbl">PROTEIN</span></div>
                    <div class="macro-item"><span class="m-val">42g</span><span class="m-lbl">HEALTHY FAT</span></div>
                    <div class="macro-item"><span class="m-val">4g</span><span class="m-lbl">NET CARBS</span></div>
                    <div class="macro-item"><span class="m-val">680</span><span class="m-lbl">CALORIES</span></div>
                </div>
                <div class="recipe-body">
                    <h4>Core Ingredients:</h4>
                    <ul>
                        <li>12 oz Grass-Fed AAA Ribeye Steak (cast iron seared in beef tallow)</li>
                        <li>2 Split Beef Femur Bones (roasted at 425°F with coarse sea salt &amp; rosemary)</li>
                        <li>1 cup Steamed Broccolini with garlic and cold-pressed extra virgin olive oil</li>
                    </ul>
                    <h4>Metabolic Purpose:</h4>
                    <p>Maximizes mTOR signaling and provides dense bioavailable zinc, iron, and collagen peptides to support connective tissue remodeling under caloric restriction.</p>
                </div>
            </div>

            <!-- Recipe 2 -->
            <div class="recipe-card">
                <div class="recipe-header">
                    <span class="recipe-type">GLYCOGEN RESET LUNCH</span>
                    <h3 class="recipe-title">Wild Pacific Halibut &amp; Avocado Glycogen Reset</h3>
                </div>
                <div class="macro-bar">
                    <div class="macro-item"><span class="m-val">58g</span><span class="m-lbl">PROTEIN</span></div>
                    <div class="macro-item"><span class="m-val">18g</span><span class="m-lbl">HEALTHY FAT</span></div>
                    <div class="macro-item"><span class="m-val">12g</span><span class="m-lbl">NET CARBS</span></div>
                    <div class="macro-item"><span class="m-val">450</span><span class="m-lbl">CALORIES</span></div>
                </div>
                <div class="recipe-body">
                    <h4>Core Ingredients:</h4>
                    <ul>
                        <li>10 oz Fresh Wild Pacific Halibut Fillet (pan-seared with ghee and lemon thyme)</li>
                        <li>1 Whole Hass Avocado (sliced with Maldon sea salt and cracked peppercorns)</li>
                        <li>2 cups Organic Baby Arugula with shaved fennel and apple cider vinaigrette</li>
                    </ul>
                    <h4>Metabolic Purpose:</h4>
                    <p>Ultra-clean protein turnover with zero GI distress. Rich in potassium and magnesium to eliminate GLP-1 electrolyte depletion.</p>
                </div>
            </div>

            <!-- Recipe 3 -->
            <div class="recipe-card">
                <div class="recipe-header">
                    <span class="recipe-type">ANABOLIC FAST-BREAKER</span>
                    <h3 class="recipe-title">Anabolic Greek Yogurt, Collagen &amp; Peptide Superberry Crunch</h3>
                </div>
                <div class="macro-bar">
                    <div class="macro-item"><span class="m-val">48g</span><span class="m-lbl">PROTEIN</span></div>
                    <div class="macro-item"><span class="m-val">8g</span><span class="m-lbl">HEALTHY FAT</span></div>
                    <div class="macro-item"><span class="m-val">18g</span><span class="m-lbl">NET CARBS</span></div>
                    <div class="macro-item"><span class="m-val">340</span><span class="m-lbl">CALORIES</span></div>
                </div>
                <div class="recipe-body">
                    <h4>Core Ingredients:</h4>
                    <ul>
                        <li>1.5 cups 0% Organic Plain Greek Yogurt (strained)</li>
                        <li>1 scoop Hydrolyzed Grass-Fed Bovine Collagen Peptides (20g protein)</li>
                        <li>1/2 cup Wild BC Blueberries and organic blackberries (polyphenol antioxidants)</li>
                        <li>1 tbsp Raw Pumpkin Seeds &amp; Ceylon cinnamon</li>
                    </ul>
                    <h4>Metabolic Purpose:</h4>
                    <p>Slow-digesting micellar casein combined with rapid-uptake collagen peptides to sustain gut mucosal barrier integrity and provide steady amino acid delivery.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_kitchen_recipes', 'keystone_kitchen_recipes_shortcode' );

/**
 * 6. Wayne Stevenson Master Profile Shortcode
 */
function keystone_founder_story_shortcode() {
    ob_start();
    ?>
    <div class="keystone-founder-profile" id="founder-master-story">
        <div class="founder-hero-grid">
            <div class="founder-image-col">
                <img src="https://i0.wp.com/keystonerecomposition.com/wp-content/uploads/2026/05/Man_performing_overhead_press4_202605021316.jpeg?w=800&ssl=1" alt="Wayne Stevenson - Keystone Founder" class="founder-main-img">
                <div class="founder-stat-bar">
                    <div class="f-stat"><span class="f-num">-48 LBS</span><span class="f-lbl">TOTAL WEIGHT LOSS</span></div>
                    <div class="f-stat"><span class="f-num">210 LBS</span><span class="f-lbl">MAINTAINED SET-POINT</span></div>
                    <div class="f-stat"><span class="f-num">5-DAY / 7-DAY</span><span class="f-lbl">PK SCHEDULING</span></div>
                </div>
            </div>

            <div class="founder-text-col">
                <span class="tool-badge">FOUNDER &amp; PRODUCER</span>
                <h2 class="founder-name">Wayne Stevenson</h2>
                <p class="founder-creds">Metabolic Researcher &amp; Performance Specialist • Recomposition Practitioner • Electronic Music Producer</p>
                
                <div class="founder-bio-text">
                    <p>I view human physiology through the exact same lens as structural engineering: <strong>if the foundation is compromised, the superstructure will inevitably collapse.</strong></p>
                    
                    <p>After years of intensive research and real-world protocol testing, I applied bio-rigorous engineering principles to my own biology—dropping <strong>48 lbs</strong>, locking in a permanent <strong>210-lb athletic set-point</strong>, and decoding the exact pharmacokinetic math behind GLP-1 agonists, peptide science, and high-intensity resistance training.</p>
                    
                    <p>Through the <strong>Keystone Master Universe</strong>, I compose original electronic music on Spotify, document rigorous biological protocols on YouTube (<a href="https://www.youtube.com/@keystoneprotocols" target="_blank" rel="noopener">@KeystoneProtocols</a>), and lead the design of future luxury alpine wellness retreats through <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener">Keystone Possibilities Ltd.</a></p>
                </div>

                <div class="founder-ecosystem-links">
                    <a href="https://keystonepossibilities.ca" class="gold-link-btn" target="_blank" rel="noopener">🏛️ Keystone Possibilities Ltd. (Partner Brand) →</a>
                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" class="spotify-link-btn" target="_blank" rel="noopener">🎵 Spotify Official Artist Channel →</a>
                    <a href="https://www.youtube.com/@keystoneprotocols" class="yt-link-btn" target="_blank" rel="noopener">▶ YouTube: @KeystoneProtocols →</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_founder_story', 'keystone_founder_story_shortcode' );
