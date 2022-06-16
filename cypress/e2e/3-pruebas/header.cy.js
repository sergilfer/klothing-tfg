describe('Carga la pagina principal', () =>{
    it('Prueba el h1 de la pagina principal', () =>{
       -//Visita la pagina principal
        cy.visit('http://localhost:3000');

        //Comprueba que existe un h1
        cy.get('[data-cy="heading-index"]').should('exist');

        //Comprueba que el h1 tiene el texto correcto
        cy.get('[data-cy="heading-index"]').invoke('text').should('equal', 'Conoce más sobre nosotros')

        //Comprueba que el h1 no tiene un texto incorrecto
        cy.get('[data-cy="heading-index"]').invoke('text').should('not.equal', 'No deberia ser correcto')

    })

    it('Prueba la seccion ver todos', () =>{
        cy.visit('http://localhost:3000/seccion');

        //Mostrar que no tenemos 4 ropas solo
        cy.get('[data-cy="ver-todos"]').should('not.have.length', 4);
        //Comprobar que la clase del boton es boton-amarillo-block
        cy.get('[data-cy="boton-todos"]').should('have.class', 'boton-amarillo-block');
        //Comprobar que el primer elemento tiene un boton cuyo texto es "Comprar"
        cy.get('[data-cy="boton-todos"]').first().invoke('text').should('equal', 'Comprar');
        //Hace click en el boton "Comprar"
        cy.get('[data-cy="boton-todos"]').first().click();
        //Comprueba que cambia la pagina y que la siguiente tiene un titulo h1 de la ropa
        cy.get('[data-cy="titulo-ropa"]').should('exist');

    })
})