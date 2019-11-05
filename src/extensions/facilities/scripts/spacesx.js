/*
    OOP Spaces
 */

const SPACE_APP = (function(){

    /**
     * A shaded region on a floorplan representing a Location
     */
    class Space {

        /**
         * Constructor
         * @param json An array returned as part of the API call
         * {
         *     location, code, name, hexColor, location
         * }
         */
        constructor(json)
        {
            this.hexColor = json.hexColor; // Hex color
            this.location = json.location; // Location ID
            this.points = json.points; // Array of points
            this.code = json.code; // Location code
            this.name = json.name; // Location name
        }
    }
});