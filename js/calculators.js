/**
 * Keystone Recomposition - Interactive Calculators Engine
 * Real-time math for GLP-1 KwikPen clicks & FDA Category 1 Peptide Reconstitution
 * Stamped: August 2026 - Wayne Stevenson
 */

document.addEventListener('DOMContentLoaded', function () {
    // =========================================================================
    // 1. GLP-1 KWIKPEN CLICK CALCULATOR (5-Day vs 7-Day & Half-Life Engine)
    // =========================================================================
    const glp1Container = document.getElementById('glp1-calculator');
    if (glp1Container) {
        let currentPenStrength = 5.0; // default 5.0 mg pen
        let currentClicks = 30; // default 30 clicks
        let currentInterval = 5; // default 5-day microdose protocol
        let currentHalfLife = 5.0; // default Tirzepatide (5.0 days)
        let currentCompound = 'tirzepatide';

        const compoundBtns = glp1Container.querySelectorAll('.compound-btn');
        const intervalBtns = glp1Container.querySelectorAll('.interval-btn');
        const strengthBtns = glp1Container.querySelectorAll('.strength-btn');
        const clickSlider = document.getElementById('click-slider');
        const clickDisplay = document.getElementById('click-val-display');
        const targetDoseInput = document.getElementById('target-dose-input');
        const calcClicksBtn = document.getElementById('calc-clicks-btn');
        const targetMatcherHint = document.getElementById('target-matcher-hint');

        // Result DOM Elements
        const resDeliveredMg = document.getElementById('res-delivered-mg');
        const resWeeklyEquivalent = document.getElementById('res-weekly-equivalent');
        const resDeliveredMl = document.getElementById('res-delivered-ml');
        const resSingleClick = document.getElementById('res-single-click');
        const resCartridgeDoses = document.getElementById('res-cartridge-doses');

        const pkDynamicsTitle = document.getElementById('pk-dynamics-title');
        const resActiveSchedule = document.getElementById('res-active-schedule');
        const resSteadyHigh = document.getElementById('res-steady-high');
        const resSteadyLow = document.getElementById('res-steady-low');
        const resAccumulationFactor = document.getElementById('res-accumulation-factor');
        const resSteadySwing = document.getElementById('res-steady-swing');
        const resTroughRetention = document.getElementById('res-trough-retention');
        const resHungerStatus = document.getElementById('res-hunger-status');

        function updateGlp1Math() {
            // Formula: Delivered Dose (D) = Clicks * (Strength / 60)
            const deliveredMg = currentClicks * (currentPenStrength / 60);
            const deliveredMl = currentClicks * 0.01;
            const syringeUnits = Math.round(currentClicks);
            const singleClickMg = currentPenStrength / 60;
            const remainingDoses = currentClicks > 0 ? (240 / currentClicks).toFixed(1) : '∞';

            // Weekly Equivalent Load = Injected Dose * (7 / Interval)
            const weeklyEquivalentMg = deliveredMg * (7 / currentInterval);

            // 1-Compartment Pharmacokinetic First-Order Superposition:
            // 1. Elimination Rate Constant: k = ln(2) / t_1/2
            const k = Math.LN2 / currentHalfLife;
            // 2. Dosing Interval: tau = currentInterval (days)
            const tau = currentInterval;
            // 3. Trough Residual Retention Fraction: R = e^(-k * tau) = 2^(-tau / t_1/2)
            const troughFraction = Math.exp(-k * tau);
            const troughPercent = (troughFraction * 100).toFixed(1);
            // 4. Peak-to-Trough Fluctuation Ratio = C_max / C_min = e^(k * tau) = 1 / R
            const fluctuationRatio = Math.exp(k * tau);
            const peakTroughRatio = fluctuationRatio.toFixed(2);

            // 5. Accumulation Factor (R_acc) = 1 / (1 - e^(-k * tau))
            const accumulationFactor = 1 / (1 - troughFraction);
            // 6. Stabilized Peak C_max = D * (1 / (1 - e^(-k * tau)))
            const steadyHighMg = deliveredMg * accumulationFactor;
            // 7. Stabilized Trough C_min = D * (e^(-k * tau) / (1 - e^(-k * tau))) = C_max * R
            const steadyLowMg = deliveredMg * (troughFraction / (1 - troughFraction));
            // 8. Peak-to-Trough Swing (C_max - C_min) = D
            const steadySwingMg = steadyHighMg - steadyLowMg;

            // Update DOM
            if (clickDisplay) clickDisplay.textContent = currentClicks + ' Clicks';
            if (resDeliveredMg) resDeliveredMg.textContent = deliveredMg.toFixed(2) + ' mg';
            if (resWeeklyEquivalent) resWeeklyEquivalent.textContent = weeklyEquivalentMg.toFixed(2) + ' mg / week';
            if (resDeliveredMl) resDeliveredMl.textContent = deliveredMl.toFixed(2) + ' mL (' + syringeUnits + ' units)';
            if (resSingleClick) resSingleClick.textContent = singleClickMg.toFixed(4) + ' mg / click';
            if (resCartridgeDoses) resCartridgeDoses.textContent = remainingDoses + ' shots at this setting';

            // Steady-State High (C_max), Low (C_min), Accumulation Factor & Fluctuation
            if (resSteadyHigh) {
                resSteadyHigh.textContent = steadyHighMg.toFixed(2) + ' mg (C_max Peak)';
            }
            if (resSteadyLow) {
                resSteadyLow.textContent = steadyLowMg.toFixed(2) + ' mg (C_min Trough)';
            }
            if (resAccumulationFactor) {
                resAccumulationFactor.textContent = accumulationFactor.toFixed(2) + 'x';
            }
            if (resSteadySwing) {
                resSteadySwing.textContent = 'Δ ' + steadySwingMg.toFixed(2) + ' mg (' + peakTroughRatio + 'x Fluctuation)';
            }

            if (pkDynamicsTitle && resActiveSchedule && resTroughRetention && resHungerStatus) {
                if (currentInterval === 5) {
                    pkDynamicsTitle.textContent = '⚡ 5-Day Micro-Dose Protocol Dynamics';
                    resActiveSchedule.textContent = 'Every 5 Days (⚡ Micro-Dose)';
                    resActiveSchedule.style.color = '#C4A265';
                    resTroughRetention.textContent = troughPercent + '% Remaining (Stable)';
                    resTroughRetention.style.color = '#10B981';
                    resHungerStatus.textContent = 'Zero Late Food Noise';
                    resHungerStatus.style.color = '#10B981';
                } else {
                    pkDynamicsTitle.textContent = '📅 7-Day Standard Schedule Dynamics';
                    resActiveSchedule.textContent = 'Every 7 Days (📅 Standard Weekly)';
                    resActiveSchedule.style.color = '#9CA3AF';
                    resTroughRetention.textContent = troughPercent + '% Remaining (Trough Drop)';
                    resTroughRetention.style.color = currentHalfLife <= 5.0 ? '#EF4444' : '#F59E0B';
                    resHungerStatus.textContent = currentHalfLife <= 5.0 ? 'Day 6–7 Food Noise Common' : 'Moderate Appetite Drift';
                    resHungerStatus.style.color = currentHalfLife <= 5.0 ? '#EF4444' : '#F59E0B';
                }
            }

            // Update Hint
            if (targetMatcherHint) {
                if (currentInterval === 5) {
                    targetMatcherHint.textContent = 'Auto-calculates 5-day injection: e.g. 5.0 mg/wk equivalent → ' + (5.0 * (5 / 7)).toFixed(2) + ' mg every 5 days (' + Math.round(((5.0 * (5 / 7)) / currentPenStrength) * 60) + ' clicks on this pen).';
                } else {
                    targetMatcherHint.textContent = 'Auto-calculates 7-day injection: e.g. 5.0 mg/wk → 5.00 mg every 7 days (' + Math.round((5.0 / currentPenStrength) * 60) + ' clicks on this pen).';
                }
            }
        }

        // Compound Selection
        compoundBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                compoundBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentCompound = this.getAttribute('data-compound');
                currentHalfLife = parseFloat(this.getAttribute('data-halflife'));
                updateGlp1Math();
            });
        });

        // Interval Selection (5-Day vs 7-Day)
        intervalBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                intervalBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentInterval = parseInt(this.getAttribute('data-interval'), 10);
                updateGlp1Math();
            });
        });

        // Strength Button Clicks
        strengthBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                strengthBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentPenStrength = parseFloat(this.getAttribute('data-mg'));
                updateGlp1Math();
            });
        });

        // Slider Changes
        if (clickSlider) {
            clickSlider.addEventListener('input', function () {
                currentClicks = parseInt(this.value, 10);
                updateGlp1Math();
            });
        }

        // Calculate Clicks from Target Weekly Dose
        if (calcClicksBtn && targetDoseInput) {
            calcClicksBtn.addEventListener('click', function () {
                const targetWeeklyMg = parseFloat(targetDoseInput.value);
                if (isNaN(targetWeeklyMg) || targetWeeklyMg <= 0) return;
                
                // If 5-day cycle: Target Injected Dose = Target Weekly * (5 / 7)
                // If 7-day cycle: Target Injected Dose = Target Weekly
                const targetInjectedMg = currentInterval === 5 ? (targetWeeklyMg * (5 / 7)) : targetWeeklyMg;
                
                // Formula: Required Clicks = (TargetInjected / Strength) * 60
                const calculatedClicks = Math.min(60, Math.max(1, Math.round((targetInjectedMg / currentPenStrength) * 60)));
                currentClicks = calculatedClicks;
                if (clickSlider) clickSlider.value = calculatedClicks;
                updateGlp1Math();
            });
        }

        // Initial Run
        updateGlp1Math();
    }

    // =========================================================================
    // 2. PEPTIDE RECONSTITUTION CALCULATOR
    // DOM IDs aligned to inc/calculators.php:
    // - res-pep-concentration (calculated peptide concentration text output)
    // - res-pep-volume (calculated dose volume text output)
    // - syringe-fill-bar (U-100 visualizer width percentage)
    // - peptide-target-dose (target dose slider/input)
    // =========================================================================
    const pepContainer = document.getElementById('peptide-calculator');
    if (pepContainer) {
        let currentVialMg = 5; // default 5 mg vial
        let currentBacMl = 2.0; // default 2.0 mL BAC water
        let currentTargetMcg = 250; // default 250 mcg dose

        const vialBtns = pepContainer.querySelectorAll('.vial-btn');
        const bacSlider = document.getElementById('bac-slider');
        const bacDisplay = document.getElementById('bac-val-display');
        const targetDoseInput = document.getElementById('peptide-target-dose');

        // Result DOM Elements (Aligned with inc/calculators.php)
        const resConcentration = document.getElementById('res-pep-concentration');
        const resSyringeUnits = document.getElementById('res-syringe-units');
        const resDoseVolume = document.getElementById('res-pep-volume');
        const resUnitValue = document.getElementById('res-pep-unit-value');
        const resTotalDoses = document.getElementById('res-pep-total-doses');
        const syringeFillBar = document.getElementById('syringe-fill-bar');
        const syringeCaptionUnits = document.getElementById('syringe-caption-units');

        function updatePeptideMath() {
            // Concentration = (Vial mg * 1000) / Bac mL  [mcg/mL]
            const concMcgPerMl = (currentVialMg * 1000) / currentBacMl;
            const concMgPerMl = (currentVialMg / currentBacMl).toFixed(2);

            // Syringe Units on 100-Unit (1.0 mL) U-100 Syringe:
            // Units = (Target mcg / Concentration mcg/mL) * 100
            const volumeMl = currentTargetMcg / concMcgPerMl;
            const units = (volumeMl * 100).toFixed(1);
            const mcgPerUnit = (concMcgPerMl / 100).toFixed(1);
            const totalDoses = Math.floor((currentVialMg * 1000) / currentTargetMcg);

            // Visual Syringe Fill (Max 100 Units = 100% width)
            const fillPercent = Math.min(100, Math.max(0, (parseFloat(units) / 100) * 100));

            if (bacDisplay) {
                bacDisplay.textContent = currentBacMl.toFixed(1) + ' mL';
            }

            if (resConcentration) {
                resConcentration.textContent = Math.round(concMcgPerMl).toLocaleString() + ' mcg/mL (' + concMgPerMl + ' mg/mL)';
            }
            if (resSyringeUnits) {
                resSyringeUnits.textContent = units + ' Units';
            }
            if (resDoseVolume) {
                resDoseVolume.textContent = volumeMl.toFixed(2) + ' mL';
            }
            if (resUnitValue) {
                resUnitValue.textContent = mcgPerUnit + ' mcg / unit';
            }
            if (resTotalDoses) {
                resTotalDoses.textContent = totalDoses + ' doses at ' + currentTargetMcg + ' mcg';
            }

            if (syringeFillBar) {
                syringeFillBar.style.width = fillPercent + '%';
            }
            if (syringeCaptionUnits) {
                syringeCaptionUnits.textContent = units + ' Units';
            }
        }

        // Vial Selection
        vialBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                vialBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentVialMg = parseFloat(this.getAttribute('data-vial'));
                updatePeptideMath();
            });
        });

        // Bac Water Slider
        if (bacSlider) {
            bacSlider.addEventListener('input', function () {
                currentBacMl = parseFloat(this.value);
                updatePeptideMath();
            });
        }

        // Target Dose Input
        if (targetDoseInput) {
            const handleTargetInput = function () {
                const val = parseFloat(this.value);
                if (!isNaN(val) && val > 0) {
                    currentTargetMcg = val;
                    updatePeptideMath();
                }
            };
            targetDoseInput.addEventListener('input', handleTargetInput);
            targetDoseInput.addEventListener('change', handleTargetInput);
        }

        // Initial Run
        updatePeptideMath();
    }

    // =========================================================================
    // 3. CALCULATOR TAB SWITCHER ENGINE (GLP-1 vs PEPTIDE RECONSTITUTION)
    // Dynamic tab switching without page reloads
    // =========================================================================
    const tabBtns = document.querySelectorAll('.calc-tab-btn');
    const glp1Wrap = document.getElementById('calc-glp1-wrap');
    const pepWrap = document.getElementById('calc-peptide-wrap');

    if (tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('data-tab') || 
                               (this.id && this.id.includes('glp1') ? 'glp1' : 
                               (this.id && this.id.includes('peptide') ? 'peptide' : 
                               (this.getAttribute('href') && this.getAttribute('href').includes('glp1') ? 'glp1' : 'peptide')));

                const glp1Btn = document.getElementById('tab-btn-glp1') || document.querySelector('.calc-tab-btn[data-tab="glp1"]');
                const pepBtn = document.getElementById('tab-btn-peptide') || document.querySelector('.calc-tab-btn[data-tab="peptide"]');

                if (target === 'glp1') {
                    if (glp1Wrap) glp1Wrap.style.display = 'block';
                    if (pepWrap) pepWrap.style.display = 'none';

                    if (glp1Btn) {
                        glp1Btn.classList.add('active');
                        glp1Btn.style.background = '#C4A265';
                        glp1Btn.style.color = '#000000';
                    }
                    if (pepBtn) {
                        pepBtn.classList.remove('active');
                        pepBtn.style.background = '#141414';
                        pepBtn.style.color = '#C4A265';
                        pepBtn.style.border = '1px solid rgba(196,162,101,0.4)';
                    }
                } else if (target === 'peptide') {
                    if (glp1Wrap) glp1Wrap.style.display = 'none';
                    if (pepWrap) pepWrap.style.display = 'block';

                    if (pepBtn) {
                        pepBtn.classList.add('active');
                        pepBtn.style.background = '#C4A265';
                        pepBtn.style.color = '#000000';
                    }
                    if (glp1Btn) {
                        glp1Btn.classList.remove('active');
                        glp1Btn.style.background = '#141414';
                        glp1Btn.style.color = '#C4A265';
                        glp1Btn.style.border = '1px solid rgba(196,162,101,0.4)';
                    }
                }
            });
        });
    }
});
