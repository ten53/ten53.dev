import * as THREE from 'three'
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js'
import {FontLoader} from 'three/examples/jsm/loaders/FontLoader.js'
import {TextGeometry} from 'three/examples/jsm/geometries/TextGeometry.js'

// ============================================================================
// Configuration
// ============================================================================

const FONT_URL = '/fonts/helvetiker_regular.typeface.json'
const MATCAP_URL = '/textures/matcaps/8.png'
const DONUT_COUNT = 80

// ============================================================================
// Initialization
// ============================================================================

async function init() {
    // ------------------------------------------------------------------------
    // DOM elements
    // ------------------------------------------------------------------------

    const container = document.querySelector('#webgl-container')
    const canvas = document.querySelector('#webgl')

    /*
     * This JavaScript file is loaded globally through app.js.
     * Return without doing anything on pages that do not contain the canvas.
     */
    if (!container || !canvas) {
        return
    }

    // ------------------------------------------------------------------------
    // Scene
    // ------------------------------------------------------------------------

    // The scene contains every object that Three.js renders.
    const scene = new THREE.Scene()

    // ------------------------------------------------------------------------
    // Camera
    // ------------------------------------------------------------------------

    /*
     * The aspect ratio starts at 1 and is corrected by resizeRenderer()
     * before the first frame is rendered.
     */
    const camera = new THREE.PerspectiveCamera(
        75,   // Vertical field of view
        1,    // Aspect ratio
        0.01, // Near clipping plane
        100   // Far clipping plane
    )

    camera.position.set(0, 0, 5)
    camera.lookAt(0, 0, 0)

    scene.add(camera)

    // ------------------------------------------------------------------------
    // Renderer
    // ------------------------------------------------------------------------

    /*
     * Pass the existing Blade canvas to Three.js instead of allowing the
     * renderer to create and append a new canvas.
     */
    const renderer = new THREE.WebGLRenderer({
        canvas,
        antialias: true,
    })

    /*
     * High-density displays can have very large pixel ratios.
     * Limiting this to 2 avoids unnecessary GPU work.
     */
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

    // ------------------------------------------------------------------------
    // Controls
    // ------------------------------------------------------------------------

    const controls = new OrbitControls(camera, canvas)

    /*
     * Damping gives the controls a smoother, more natural movement.
     * controls.update() must be called during every animation frame.
     */
    controls.enableDamping = true

    // ------------------------------------------------------------------------
    // Resize handling
    // ------------------------------------------------------------------------

    function resizeRenderer() {
        /*
         * The container owns the layout dimensions.
         * The canvas simply fills the available container space.
         */
        const width = container.clientWidth
        const height = container.clientHeight

        // Avoid an invalid aspect ratio when the container has no dimensions.
        if (width === 0 || height === 0) {
            return
        }

        camera.aspect = width / height
        camera.updateProjectionMatrix()

        /*
         * Passing false prevents Three.js from changing the canvas CSS size.
         * Tailwind remains responsible for its visible width and height.
         */
        renderer.setSize(width, height, false)

        /*
         * Recalculate the pixel ratio in case the browser moves between
         * displays with different pixel densities.
         */
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
    }

    /*
     * ResizeObserver watches the container itself. This catches changes caused
     * by flexbox, grid, viewport resizing, sidebars, or other layout changes.
     */
    const resizeObserver = new ResizeObserver(resizeRenderer)

    resizeObserver.observe(container)

    // Apply the correct dimensions before rendering the first frame.
    resizeRenderer()

    // ------------------------------------------------------------------------
    // Asset loaders
    // ------------------------------------------------------------------------

    const textureLoader = new THREE.TextureLoader()
    const fontLoader = new FontLoader()

    // Load the matcap texture and font before creating the scene objects.
    const matcapTexture = textureLoader.load(MATCAP_URL)
    const font = await fontLoader.loadAsync(FONT_URL)

    /*
     * Matcap image files contain display color data, so they should use
     * the sRGB color space.
     */
    matcapTexture.colorSpace = THREE.SRGBColorSpace

    // ------------------------------------------------------------------------
    // Shared material
    // ------------------------------------------------------------------------

    /*
     * The text and donuts use the same material.
     * Reusing it avoids creating an unnecessary material for every object.
     */
    const matcapMaterial = new THREE.MeshMatcapMaterial({
        matcap: matcapTexture,
    })

    // ------------------------------------------------------------------------
    // Text
    // ------------------------------------------------------------------------

    const textGeometry = new TextGeometry('Collect moments - \n not things ***', {
        font,
        size: 0.5,
        depth: 0.2,
        curveSegments: 5,
        bevelEnabled: true,
        bevelThickness: 0.03,
        bevelSize: 0.02,
        bevelOffset: 0,
        bevelSegments: 4,
    })

    /*
     * TextGeometry begins at its local origin rather than being centered.
     * center() moves its bounding box around the origin of the scene.
     */
    textGeometry.center()

    const text = new THREE.Mesh(textGeometry, matcapMaterial)

    scene.add(text)

    // Create an invisible exclusion area around and in front of the text.
    const textExclusionBox = textGeometry.boundingBox.clone()

    textExclusionBox.min.x -= 0.5
    textExclusionBox.min.y -= 0.5
    textExclusionBox.min.z -= 0.5

    textExclusionBox.max.x += 0.5
    textExclusionBox.max.y += 0.5
    textExclusionBox.max.z += 2

    // To account for the donut’s radius, increase the padding.
    const exclusionPadding = 0.8

    textExclusionBox.min.x -= exclusionPadding
    textExclusionBox.min.y -= exclusionPadding
    textExclusionBox.min.z -= exclusionPadding

    textExclusionBox.max.x += exclusionPadding
    textExclusionBox.max.y += exclusionPadding
    textExclusionBox.max.z += 2

    // ------------------------------------------------------------------------
    // Donuts
    // ------------------------------------------------------------------------

    /*
     * All donuts share one geometry and one material.
     * Each mesh then receives its own position, rotation, and scale.
     */
    const donutGeometry = new THREE.TorusGeometry(
        0.3, // Main radius
        0.2, // Tube radius
        20,  // Radial segments
        45   // Tubular segments
    )

    for (let i = 0; i < DONUT_COUNT; i++) {
        const donut = new THREE.Mesh(donutGeometry, matcapMaterial)

        /*
         * Keep generating positions until one falls outside the exclusion box.
         * This prevents donuts from appearing inside or directly in front of
         * the text.
         */
        do {
            // Spread the donuts randomly through a 10 × 10 × 10 area.
            donut.position.set(
                (Math.random() - 0.5) * 10,
                (Math.random() - 0.5) * 10,
                (Math.random() - 0.5) * 10
            )
        } while (textExclusionBox.containsPoint(donut.position))

        donut.rotation.set(
            Math.random() * Math.PI,
            Math.random() * Math.PI,
            0
        )

        donut.scale.setScalar(Math.random())

        scene.add(donut)
    }


    // ------------------------------------------------------------------------
    // Animation loop
    // ------------------------------------------------------------------------

    function animate() {
        /*
         * Required when OrbitControls damping is enabled.
         * Without this, the damping effect will not work correctly.
         */
        controls.update()

        renderer.render(scene, camera)

        requestAnimationFrame(animate)
    }

    requestAnimationFrame(animate)
}

init().catch((error) => {
    console.error('Failed to initialize the Three.js scene:', error)
})
