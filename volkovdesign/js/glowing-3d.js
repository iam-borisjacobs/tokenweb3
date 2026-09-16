/**
 * High-Performance, Subtle Glowing 3D Animations for ECX Groups
 * Powered by Three.js
 */
(function() {
    'use strict';

    // Wait until THREE is available and DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof THREE === 'undefined') return;

        initHero3DEmblem();
        initSecurity3DVault();
    });

    /**
     * 3D Animation #1: Holographic Cryptographic Core
     * Embedded in the Hero Sentinel HUD
     */
    function initHero3DEmblem() {
        var container = document.getElementById('hero-3d-emblem');
        if (!container) return;

        var width = container.clientWidth || 220;
        var height = container.clientHeight || 220;

        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);
        camera.position.z = 5;

        var renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true, powerPreference: 'low-power' });
        renderer.setSize(width, height);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        // Core 3D Mesh: Icosahedron Wireframe with Neon Glow
        var coreGeo = new THREE.IcosahedronGeometry(1.3, 1);
        var coreMat = new THREE.MeshBasicMaterial({
            color: 0x00e5ff,
            wireframe: true,
            transparent: true,
            opacity: 0.75
        });
        var coreMesh = new THREE.Mesh(coreGeo, coreMat);
        scene.add(coreMesh);

        // Inner solid crystal
        var innerGeo = new THREE.OctahedronGeometry(0.75, 0);
        var innerMat = new THREE.MeshBasicMaterial({
            color: 0x8b5cf6,
            wireframe: true,
            transparent: true,
            opacity: 0.9
        });
        var innerMesh = new THREE.Mesh(innerGeo, innerMat);
        scene.add(innerMesh);

        // Surrounding orbital ring 1 (Cyan)
        var ring1Geo = new THREE.TorusGeometry(1.85, 0.025, 16, 64);
        var ring1Mat = new THREE.MeshBasicMaterial({
            color: 0x00e5ff,
            transparent: true,
            opacity: 0.6
        });
        var ring1 = new THREE.Mesh(ring1Geo, ring1Mat);
        ring1.rotation.x = Math.PI / 3;
        scene.add(ring1);

        // Surrounding orbital ring 2 (Violet)
        var ring2Geo = new THREE.TorusGeometry(2.05, 0.02, 16, 64);
        var ring2Mat = new THREE.MeshBasicMaterial({
            color: 0xa855f7,
            transparent: true,
            opacity: 0.5
        });
        var ring2 = new THREE.Mesh(ring2Geo, ring2Mat);
        ring2.rotation.y = Math.PI / 4;
        scene.add(ring2);

        // Floating Micro-Particles
        var particleCount = 45;
        var particleGeo = new THREE.BufferGeometry();
        var positions = new Float32Array(particleCount * 3);
        for (var i = 0; i < particleCount * 3; i += 3) {
            positions[i] = (Math.random() - 0.5) * 4.5;
            positions[i + 1] = (Math.random() - 0.5) * 4.5;
            positions[i + 2] = (Math.random() - 0.5) * 4.5;
        }
        particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        var particleMat = new THREE.PointsMaterial({
            color: 0x00e5ff,
            size: 0.06,
            transparent: true,
            opacity: 0.75,
            blending: THREE.AdditiveBlending
        });
        var particles = new THREE.Points(particleGeo, particleMat);
        scene.add(particles);

        // Mouse Parallax Interaction
        var mouseX = 0, mouseY = 0;
        var targetX = 0, targetY = 0;
        window.addEventListener('mousemove', function(e) {
            mouseX = (e.clientX / window.innerWidth - 0.5) * 0.8;
            mouseY = (e.clientY / window.innerHeight - 0.5) * 0.8;
        }, { passive: true });

        // Animation Loop
        var clock = new THREE.Clock();
        function animate() {
            requestAnimationFrame(animate);
            var delta = clock.getDelta();
            var time = clock.getElapsedTime();

            // Smooth gentle rotation
            coreMesh.rotation.y += 0.008;
            coreMesh.rotation.x += 0.005;

            innerMesh.rotation.y -= 0.015;
            innerMesh.rotation.z += 0.01;

            ring1.rotation.z += 0.012;
            ring2.rotation.x += 0.009;

            // Subtle vertical floating wave
            coreMesh.position.y = Math.sin(time * 1.5) * 0.08;
            innerMesh.position.y = Math.sin(time * 1.5) * 0.08;

            particles.rotation.y += 0.002;

            // Mouse parallax easing
            targetX += (mouseX - targetX) * 0.05;
            targetY += (mouseY - targetY) * 0.05;
            scene.rotation.y = targetX * 0.5;
            scene.rotation.x = targetY * 0.5;

            renderer.render(scene, camera);
        }
        animate();

        // Responsive resize
        window.addEventListener('resize', function() {
            var newW = container.clientWidth || 220;
            var newH = container.clientHeight || 220;
            camera.aspect = newW / newH;
            camera.updateProjectionMatrix();
            renderer.setSize(newW, newH);
        });
    }

    /**
     * 3D Animation #2: Gyroscopic 3D Vault Core
     * Embedded in the FTX Story / Asset Defense Section
     */
    function initSecurity3DVault() {
        var container = document.getElementById('security-3d-vault');
        if (!container) return;

        var width = container.clientWidth || 240;
        var height = container.clientHeight || 240;

        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);
        camera.position.z = 5.2;

        var renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true, powerPreference: 'low-power' });
        renderer.setSize(width, height);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        // Outer Gyro Ring (Emerald / Solvency)
        var outerRingGeo = new THREE.TorusGeometry(1.8, 0.04, 16, 72);
        var outerRingMat = new THREE.MeshBasicMaterial({
            color: 0x10b981,
            transparent: true,
            opacity: 0.8
        });
        var outerRing = new THREE.Mesh(outerRingGeo, outerRingMat);
        scene.add(outerRing);

        // Middle Gyro Ring (Cyan / Defense)
        var midRingGeo = new THREE.TorusGeometry(1.45, 0.035, 16, 64);
        var midRingMat = new THREE.MeshBasicMaterial({
            color: 0x00e5ff,
            transparent: true,
            opacity: 0.75
        });
        var midRing = new THREE.Mesh(midRingGeo, midRingMat);
        midRing.rotation.x = Math.PI / 2;
        scene.add(midRing);

        // Inner Shield Core (Dodecahedron)
        var shieldGeo = new THREE.DodecahedronGeometry(0.9, 0);
        var shieldMat = new THREE.MeshBasicMaterial({
            color: 0x38bdf8,
            wireframe: true,
            transparent: true,
            opacity: 0.85
        });
        var shieldCore = new THREE.Mesh(shieldGeo, shieldMat);
        scene.add(shieldCore);

        // Tiny center glowing node
        var nodeGeo = new THREE.SphereGeometry(0.3, 16, 16);
        var nodeMat = new THREE.MeshBasicMaterial({
            color: 0x10b981,
            transparent: true,
            opacity: 0.95
        });
        var node = new THREE.Mesh(nodeGeo, nodeMat);
        scene.add(node);

        // Particle field
        var pCount = 35;
        var pGeo = new THREE.BufferGeometry();
        var pPos = new Float32Array(pCount * 3);
        for (var j = 0; j < pCount * 3; j += 3) {
            pPos[j] = (Math.random() - 0.5) * 4;
            pPos[j + 1] = (Math.random() - 0.5) * 4;
            pPos[j + 2] = (Math.random() - 0.5) * 4;
        }
        pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
        var pMat = new THREE.PointsMaterial({
            color: 0x10b981,
            size: 0.05,
            transparent: true,
            opacity: 0.7
        });
        var pMesh = new THREE.Points(pGeo, pMat);
        scene.add(pMesh);

        // Animation
        var clock = new THREE.Clock();
        function animateVault() {
            requestAnimationFrame(animateVault);
            var time = clock.getElapsedTime();

            outerRing.rotation.x += 0.008;
            outerRing.rotation.y += 0.006;

            midRing.rotation.y += 0.01;
            midRing.rotation.z += 0.007;

            shieldCore.rotation.y -= 0.012;
            shieldCore.rotation.x += 0.008;

            node.scale.setScalar(1 + Math.sin(time * 3) * 0.15);

            pMesh.rotation.y -= 0.003;

            renderer.render(scene, camera);
        }
        animateVault();

        // Resize
        window.addEventListener('resize', function() {
            var nW = container.clientWidth || 240;
            var nH = container.clientHeight || 240;
            camera.aspect = nW / nH;
            camera.updateProjectionMatrix();
            renderer.setSize(nW, nH);
        });
    }
})();
