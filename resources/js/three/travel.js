import * as THREE from 'three'

// ============================================================================
// DOM Elements
// ============================================================================

// The container determines how much page space is available.
// The canvas fills this container.
const container = document.querySelector('#webgl-container')
const canvas = document.querySelector('#webgl')

// Stop here on pages that do not contain the Three.js canvas.
if (!container || !canvas) {
    throw new Error('Three.js container or canvas not found.')
}

// ============================================================================
// Scene
// ============================================================================

// The scene contains everything rendered by Three.js.
const scene = new THREE.Scene()

// ============================================================================
// Camera
// ============================================================================

// Start with an aspect ratio of 1.
// The correct ratio is applied immediately by resizeRenderer().
const camera = new THREE.PerspectiveCamera(
    75,   // Field of view
    1,    // Aspect ratio
    0.01, // Near clipping plane
    100   // Far clipping plane
)

// Move the camera away from the origin so the cube is visible.
camera.position.set(0, 0, 3)

// Point the camera toward the center of the scene.
camera.lookAt(0, 0, 0)

scene.add(camera)

// ============================================================================
// Renderer
// ============================================================================

// Use the existing <canvas> element rather than creating a new one.
const renderer = new THREE.WebGLRenderer({
    canvas,
    antialias: true,
})

// Limit the pixel ratio to avoid unnecessary work on high-density screens.
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

// ============================================================================
// Resize Handling
// ============================================================================

function resizeRenderer() {
    // Read the available size from the container, not the canvas.
    const width = container.clientWidth
    const height = container.clientHeight

    // Avoid invalid aspect ratios while the element is hidden or has no size.
    if (width === 0 || height === 0) {
        return
    }

    // Keep the camera projection aligned with the container shape.
    camera.aspect = width / height
    camera.updateProjectionMatrix()

    /*
     * Resize the drawing buffer.
     *
     * Passing false prevents Three.js from writing inline CSS width and height.
     * CSS remains responsible for the canvas's visible dimensions.
     */
    renderer.setSize(width, height, false)
}

// Observe the actual container.
// This catches flexbox, grid, sidebar and viewport-driven size changes.
const resizeObserver = new ResizeObserver(resizeRenderer)

resizeObserver.observe(container)

// Set the correct size before the first rendered frame.
resizeRenderer()

// ============================================================================
// Object
// ============================================================================

// Geometry defines the cube's shape.
const geometry = new THREE.BoxGeometry(1, 1, 1)

// Material defines how the cube's surface is drawn.
const material = new THREE.MeshBasicMaterial()

// A mesh combines geometry and material into a renderable object.
const cube = new THREE.Mesh(geometry, material)

scene.add(cube)

// ============================================================================
// Timer
// ============================================================================

// Timer replaces the deprecated THREE.Clock.
const timer = new THREE.Timer()

// ============================================================================
// Animation Loop
// ============================================================================

function animate(timestamp) {
    /*
     * Timer.update() must run once per frame.
     * Passing the requestAnimationFrame timestamp keeps it synchronized
     * with the browser's animation timing.
     */
    timer.update(timestamp)

    const elapsedTime = timer.getElapsed()

    // Example animation based on elapsed time.
    // cube.rotation.y = elapsedTime

    renderer.render(scene, camera)

    requestAnimationFrame(animate)
}

requestAnimationFrame(animate)
